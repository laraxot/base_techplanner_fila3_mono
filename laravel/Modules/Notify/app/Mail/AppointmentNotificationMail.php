<?php

declare(strict_types=1);

namespace Modules\Notify\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 2b275b1a (.)
=======
>>>>>>> b53b1a24 (.)
// use Modules\SaluteOra\Models\Appointment;

class AppointmentNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Dati della notifica dell'appuntamento.
     *
     * @var array<string, mixed>
     */
    public array $notificationData;

    /**
     * Crea una nuova istanza del messaggio.
     *
<<<<<<< HEAD
<<<<<<< HEAD
     * @param array<string, mixed> $notificationData
=======
     * @param  array<string, mixed>  $notificationData
>>>>>>> 2b275b1a (.)
=======
     * @param array<string, mixed> $notificationData
>>>>>>> b53b1a24 (.)
     */
    public function __construct(array $notificationData)
    {
        $this->notificationData = $notificationData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $appointment = $this->notificationData['appointment'];
        $type = $this->notificationData['type'];
<<<<<<< HEAD
<<<<<<< HEAD
        
        $subject = match($type) {
=======

        $subject = match ($type) {
>>>>>>> 2b275b1a (.)
=======
        
        $subject = match($type) {
>>>>>>> b53b1a24 (.)
            'confirmed' => 'Conferma Appuntamento',
            'reminder' => 'Promemoria Appuntamento',
            'cancelled' => 'Cancellazione Appuntamento',
            'rescheduled' => 'Modifica Appuntamento',
            default => 'Notifica Appuntamento',
        };
<<<<<<< HEAD
<<<<<<< HEAD
        
<<<<<<< HEAD
        if (is_object($appointment) && isset($appointment->id) && $appointment->id) {
=======
        if (is_object($appointment) && property_exists($appointment, 'id') && $appointment->id) {
>>>>>>> 9fd314be (.)
            $subject .= ' #' . $appointment->id;
        }
        
=======

=======
        
>>>>>>> b53b1a24 (.)
        if (is_object($appointment) && isset($appointment->id) && $appointment->id) {
            $subject .= ' #' . $appointment->id;
        }
<<<<<<< HEAD

>>>>>>> 2b275b1a (.)
=======
        
>>>>>>> b53b1a24 (.)
        return new Envelope(
            subject: $subject,
            tags: ['appointment', $type],
            metadata: [
<<<<<<< HEAD
<<<<<<< HEAD
                'appointment_id' => is_object($appointment) && isset($appointment->id) ? $appointment->id : null,
=======
                'appointment_id' => is_object($appointment) && property_exists($appointment, 'id') ? $appointment->id : null,
>>>>>>> 9fd314be (.)
=======
                'appointment_id' => is_object($appointment) && isset($appointment->id) ? $appointment->id : null,
>>>>>>> 2b275b1a (.)
                'type' => $type,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $type = $this->notificationData['type'];
<<<<<<< HEAD
<<<<<<< HEAD
        
        // Determina il template da utilizzare in base al tipo di notifica
        $view = match($type) {
=======

        // Determina il template da utilizzare in base al tipo di notifica
        $view = match ($type) {
>>>>>>> 2b275b1a (.)
=======
        
        // Determina il template da utilizzare in base al tipo di notifica
        $view = match($type) {
>>>>>>> b53b1a24 (.)
            'confirmed' => 'notify::emails.appointments.confirmed',
            'reminder' => 'notify::emails.appointments.reminder',
            'cancelled' => 'notify::emails.appointments.cancelled',
            'rescheduled' => 'notify::emails.appointments.rescheduled',
            default => 'notify::emails.appointments.generic',
        };
<<<<<<< HEAD
<<<<<<< HEAD
        
=======

>>>>>>> 2b275b1a (.)
=======
        
>>>>>>> b53b1a24 (.)
        return new Content(
            view: $view,
            with: [
                'appointment' => $this->notificationData['appointment'],
                'patient' => $this->notificationData['patient'],
                'type' => $type,
                'additionalData' => $this->notificationData['additionalData'] ?? [],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
