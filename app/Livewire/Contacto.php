<?php

namespace App\Livewire;

use App\Models\Ajuste;
use App\Models\MensajeContacto;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contacto — ANASCOR')]
#[Layout('layouts.public.base')]
class Contacto extends Component
{
    public string $nombre = '';

    public string $correo = '';

    public string $asunto = '';

    public string $mensaje = '';

    public string $trampa = '';

    public bool $enviado = false;

    public ?string $errorEnvio = null;

    public function enviar(): void
    {
        // Honeypot: si un bot llenó el campo oculto, simular éxito sin guardar
        if ($this->trampa !== '') {
            $this->enviado = true;

            return;
        }

        $key = 'contacto:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->errorEnvio = 'Demasiados intentos. Por favor, espere unos minutos antes de enviar otro mensaje.';

            return;
        }

        $this->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:150'],
            'asunto' => ['required', 'string', 'max:200'],
            'mensaje' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede superar 100 caracteres.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingrese un correo electrónico válido.',
            'asunto.required' => 'El asunto es obligatorio.',
            'asunto.max' => 'El asunto no puede superar 200 caracteres.',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'mensaje.max' => 'El mensaje no puede superar 2000 caracteres.',
        ]);

        RateLimiter::hit($key, 300);

        MensajeContacto::create([
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'asunto' => $this->asunto,
            'mensaje' => $this->mensaje,
        ]);

        $destinatario = Ajuste::get('correo', 'info@anascor.org');

        try {
            Mail::raw(
                "Nuevo mensaje de contacto desde el sitio web de ANASCOR.\n\n".
                "Nombre: {$this->nombre}\n".
                "Correo: {$this->correo}\n".
                "Asunto: {$this->asunto}\n\n".
                "Mensaje:\n{$this->mensaje}",
                fn ($mail) => $mail
                    ->to($destinatario)
                    ->replyTo($this->correo, $this->nombre)
                    ->subject("Contacto web: {$this->asunto}")
            );
        } catch (\Throwable) {
            // Si el correo falla el mensaje ya quedó guardado en la BD
        }

        $this->reset(['nombre', 'correo', 'asunto', 'mensaje', 'trampa']);
        $this->errorEnvio = null;
        $this->enviado = true;
    }

    public function render()
    {
        return view('livewire.contacto', [
            'direccion' => Ajuste::get('direccion'),
            'correo' => Ajuste::get('correo'),
            'facebook' => Ajuste::get('facebook'),
            'instagram' => Ajuste::get('instagram'),
            'tiktok' => Ajuste::get('tiktok'),
            'mapaUrl' => Ajuste::get('mapa_embed_url'),
        ]);
    }
}
