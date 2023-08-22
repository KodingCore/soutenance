<?php

class AppointmentManager extends AbstractManager
{
    
    public function getAppointments() : ? array
    {
        $query = $this->db->prepare("SELECT * FROM appointments");
        $query->execute();
        $appointments = $query->fetchAll(PDO::FETCH_ASSOC);
        if($appointments)
        {
            $appointmentsTab = [];
            foreach($appointments as $appointment)
            {
                $appointmentInstance = new Appointment($appointment["user_id"], $appointment["appointment_date"], $appointment["appointment_time"], $appointment["communication_preference"]);
                $appointmentInstance->setAppointmentId($appointment["appointment_id"]);
                array_push($appointmentsTab, $appointmentInstance);
            }
            return $appointmentsTab;
        }
        else
        {
            return null;
        }
    }

    public function insertAppointment(Appointment $appointment)
    {
        $query = $this->db->prepare("INSERT INTO appointments (user_id, appointment_date, appointment_time, communication_preference) VALUES(:user_id, :appointment_date, :appointment_time, :communication_preference)");
        $parameters = [
            "user_id" => $appointment->getUserId(),
            "appointment_date" => $appointment->getAppointmentDate(),
            "appointment_time" => $appointment->getAppointmentTime(),
            "communication_preference" => $appointment->getCommunicationPreference()
        ];
        $query->execute($parameters);
    }

    public function deleteAppointmentByAppointmentId(int $appointment_id)
    {
        $query = $this->db->prepare("DELETE FROM appointments WHERE appointment_id = :appointment_id");
        $parameters = [
            "appointment_id" => $appointment_id
        ];
        $query->execute($parameters);
    }

    public function deleteAppointmentByUserId(int $user_id)
    {
        $query = $this->db->prepare("DELETE FROM appointments WHERE user_id = :user_id");
        $parameters = [
            "user_id" => $user_id
        ];
        $query->execute($parameters);
    }

    public function editAppointment(Appointment $appointment)
    {
        $query = $this->db->prepare("UPDATE appointments SET user_id = :user_id, appointment_date = :appointment_date, appointment_time = :appointment_time, communication_preference = :communication_preference WHERE appointment_id = :appointment_id");
        $parameters = [
            "user_id" => $appointment->getUserId(),
            "appointment_date" => $appointment->getAppointmentDate(),
            "appointment_time" => $appointment->getAppointmentTime(),
            "communication_preference" => $appointment->getCommunicationPreference(),
            "appointment_id" => $appointment->getAppointmentId()
        ];
        $query->execute($parameters);
    }

    public function getAppointmentByAppointmentId(int $appointment_id) : ? Appointment
    {
        $query = $this->db->prepare("SELECT * FROM appointments WHERE appointment_id = :appointment_id");
        $parameters = [
            "appointment_id" => $appointment_id
        ];
        $query->execute($parameters);
        $appointment = $query->fetch(PDO::FETCH_ASSOC);
        if($appointment)
        {
            $appointmentInstance = new Appointment($appointment["user_id"], $appointment["appointment_date"], $appointment["appointment_time"], $appointment["communication_preference"]);
            $appointmentInstance->setAppointmentId($appointment["appointment_id"]);
            return $appointmentInstance;
        }
        else
        {
            return null;
        }
    }
}