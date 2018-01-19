<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GameAssignmentMailable extends Mailable
{
  use Queueable, SerializesModels;

  /**
     * Create a new message instance.
     *
     * @return void
     */
  
  public $student;
  public $games;
  
  public function __construct($student, $games)
  {
    $this->student = $student;
    $this->games = $games;
  }

  /**
     * Build the message.
     *
     * @return $this
     */
  public function build()
  {
    return $this->markdown('emails.game_assignment_email')->subject("CORRECTED - Your Basketball Assignments");
  }
}
