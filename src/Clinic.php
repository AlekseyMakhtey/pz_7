<?php

namespace App;

class Clinic
{
    private $doctors;
    private $appointments;

    public function __construct()
    {
        // Список врачей
        $this->doctors = [
            'Dr. Иванов' => ['specialty' => 'Терапевт'],
            'Dr. Петров' => ['specialty' => 'Хирург'],
            'Dr. Сидоров' => ['specialty' => 'Кардиолог'],
        ];

        // Список назначенных приемов
        $this->appointments = [];
    }

    /**
     * Записать пациента на прием к врачу
     *
     * @param string $doctor
     * @param string $patientName
     * @param string $time
     * @return string
     * @throws \Exception
     */
    public function bookAppointment($doctor, $patientName, $time)
    {
        if (!isset($this->doctors[$doctor])) {
            throw new \Exception("Врач не найден.");
        }

        // Проверка, что прием не занят
        if (isset($this->appointments[$time])) {
            throw new \Exception("Время занято.");
        }

        $this->appointments[$time] = ['doctor' => $doctor, 'patient' => $patientName];
        return "Пациент {$patientName} записан на прием к {$doctor} в {$time}.";
    }

    /**
     * Получить список приемов
     *
     * @return array
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * Получить специальность врача
     *
     * @param string $doctor
     * @return string
     * @throws \Exception
     */
    public function getDoctorSpecialty($doctor)
    {
        if (!isset($this->doctors[$doctor])) {
            throw new \Exception("Врач не найден.");
        }
        return $this->doctors[$doctor]['specialty'];
    }
}
