<?php

use PHPUnit\Framework\TestCase;
use App\Clinic;

class ClinicTest extends TestCase
{
    private $clinic;

    protected function setUp(): void
    {
        $this->clinic = new Clinic();
    }

    public function testBookAppointment()
    {
        // Записываем пациента на прием
        $result = $this->clinic->bookAppointment('Dr. Иванов', 'Иванов Иван', '10:00');
        $this->assertEquals('Пациент Иванов Иван записан на прием к Dr. Иванов в 10:00.', $result);
    }

    public function testBookAppointmentWhenTimeIsTaken()
    {
        // Записываем первого пациента
        $this->clinic->bookAppointment('Dr. Иванов', 'Иванов Иван', '10:00');
        
        // Пробуем записать другого пациента в это же время
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Время занято.');
        $this->clinic->bookAppointment('Dr. Петров', 'Петров Петр', '10:00');
    }

    public function testGetDoctorSpecialty()
    {
        // Проверяем специальность врача
        $specialty = $this->clinic->getDoctorSpecialty('Dr. Иванов');
        $this->assertEquals('Терапевт', $specialty);
    }

    public function testGetDoctorSpecialtyWhenDoctorNotFound()
    {
        // Проверяем, что будет, если врача нет в списке
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Врач не найден.');
        $this->clinic->getDoctorSpecialty('Dr. Неизвестный');
    }

    public function testGetAppointments()
    {
        // Записываем пациентов на прием
        $this->clinic->bookAppointment('Dr. Иванов', 'Иванов Иван', '10:00');
        $this->clinic->bookAppointment('Dr. Петров', 'Петров Петр', '11:00');
        
        // Проверяем список приемов
        $appointments = $this->clinic->getAppointments();
        $this->assertCount(2, $appointments);
    }
}

// vendor/bin/phpunit tests/ClinicTest.php
// -jar jenkins.war
// D:\Учёба\ИТиВП>java -jar jenkins.war