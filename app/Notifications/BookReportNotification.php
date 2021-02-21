<?php

namespace App\Notifications;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookReportNotification extends Notification
{
    use Queueable;

    private $book;
    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Book $book, $data)
    {
        $this->book = $book;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Report from: ' . $this->data['email'])
                    ->line('Book: ' . $this->book->title)
                    ->action('visit book', route('books.show', ['book' => $this->book]))
                    ->line('Comment: ' . $this->data['comment']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
