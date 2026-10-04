<?php

namespace App\Console\Commands;

use App\Mail\NuevosMorososMail;
use App\Models\Ajuste;
use App\Models\Asociado;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

#[Signature('app:recalcular-morosidad')]
#[Description('Recalcula morosidad de asociados y notifica a tesorería los nuevos morosos del día')]
class RecalcularMorosidad extends Command
{
    public function handle(): int
    {
        $diasGracia = (int) Ajuste::get('dias_gracia', '3');
        $hoy = now()->startOfDay();
        $limite = $hoy->copy()->subDays($diasGracia);

        $asociadosActivos = Asociado::where('activo', true)->get();

        $nuevosMorosos = collect();

        foreach ($asociadosActivos as $asociado) {
            $debeSerMoroso = $asociado->pagado_hasta === null
                || $asociado->pagado_hasta->lt($limite);

            if ($debeSerMoroso && ! $asociado->moroso) {
                $asociado->update(['moroso' => true]);
                $nuevosMorosos->push($asociado);
            } elseif (! $debeSerMoroso && $asociado->moroso) {
                $asociado->update(['moroso' => false]);
            }
        }

        $this->info("Procesados: {$asociadosActivos->count()} asociados.");
        $this->info("Nuevos morosos hoy: {$nuevosMorosos->count()}.");

        if ($nuevosMorosos->isNotEmpty()) {
            $this->enviarNotificacion($nuevosMorosos, $hoy->toDateString());
        }

        return Command::SUCCESS;
    }

    private function enviarNotificacion(Collection $morosos, string $fecha): void
    {
        $destinatario = Ajuste::get('correo_tesoreria', 'tesoanascor@gmail.com');

        try {
            Mail::to($destinatario)->send(new NuevosMorososMail($morosos, $fecha));
        } catch (\Throwable $e) {
            $this->warn("No se pudo enviar el correo de notificación: {$e->getMessage()}");
        }
    }
}
