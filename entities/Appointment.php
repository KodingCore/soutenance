<?php

class Appointment implements JsonSerializable
{
    private ?int $appointment_id;
    private int $user_id;
    private string $appointment_date;
    private string $appointment_time;
    private string $communication_preference;
    
    public function __construct(int $user_id, string $appointment_date, string $appointment_time, string $communication_preference) {
        $this->appointment_id = null;
        $this->user_id = $user_id;
        $this->appointment_date = $appointment_date;
        $this->appointment_time = $appointment_time;
        $this->communication_preference = $communication_preference;
    }
    
    // Getters
    public function getAppointmentId(): int { return $this->appointment_id; }
    public function getUserId(): int { return $this->user_id; }
    public function getAppointmentDate(): string { return $this->appointment_date; }
    public function getAppointmentTime(): string { return $this->appointment_time; }
    public function getCommunicationPreference(): string { return $this->communication_preference; }
    
    // Setters
    public function setAppointmentId(int $appointment_id): void { $this->appointment_id = $appointment_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function setAppointmentDate(string $appointment_date): void { $this->appointment_date = $appointment_date; }
    public function setAppointmentTime(string $appointment_time): void { $this->appointment_time = $appointment_time; }
    public function setCommunicationPreference(string $communication_preference): void { $this->communication_preference = $communication_preference; }

    public function jsonSerialize() {
        return [
            "ID" => $this->appointment_id,
            "ID utilisateur" => $this->user_id,
            "Date" => $this->appointment_date,
            "Heure" => $this->appointment_time,
            "Préférence de com" => $this->communication_preference
        ];
    }
}
