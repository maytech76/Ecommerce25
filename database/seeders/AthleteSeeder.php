<?php

namespace Database\Seeders;

use App\Models\Athlete;
use App\Models\State;
use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder
{
    public function run(): void
    {
        $stateIds = State::pluck('id')->toArray();

        $athletes = [
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC1234567',
                'name' => 'Juan Carlos',
                'last_name' => 'Pérez Gómez',
                'birth_date' => '1995-06-15',
                'gender' => 'masculino',
                'phone' => '555-1234-5678',
                'state_id' => $stateIds[0] ?? null,
                'city_id' => null,
                'email' => 'juan.perez@example.com',
                'team_name' => 'Equipo Alpha',
                'medical_conditions' => 'Asma controlada',
                'allergies' => 'Polen',
                'blood_type' => 'A+',
                'emergency_contact_name' => 'María Gómez',
                'emergency_contact_phone' => '555-9876-5432',
                'notes' => 'Atleta de alto rendimiento',
                'status' => 'activo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC7654321',
                'name' => 'María Fernanda',
                'last_name' => 'Rodríguez Silva',
                'birth_date' => '1998-09-23',
                'gender' => 'femenino',
                'phone' => '555-8765-4321',
                'state_id' => $stateIds[1] ?? null,
                'city_id' => null,
                'email' => 'maria.rodriguez@example.com',
                'team_name' => 'Equipo Beta',
                'medical_conditions' => null,
                'allergies' => 'Penicilina',
                'blood_type' => 'B+',
                'emergency_contact_name' => 'Carlos Rodríguez',
                'emergency_contact_phone' => '555-5432-1987',
                'notes' => 'Excelente rendimiento',
                'status' => 'activo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC9988776',
                'name' => 'Roberto',
                'last_name' => 'Martínez López',
                'birth_date' => '1990-03-10',
                'gender' => 'masculino',
                'phone' => '555-6543-2109',
                'state_id' => $stateIds[2] ?? null,
                'city_id' => null,
                'email' => 'roberto.martinez@example.com',
                'team_name' => 'Equipo Gamma',
                'medical_conditions' => 'Hipertensión',
                'allergies' => null,
                'blood_type' => 'O+',
                'emergency_contact_name' => 'Ana Martínez',
                'emergency_contact_phone' => '555-2109-8765',
                'notes' => 'Suspendido por falta disciplinaria',
                'status' => 'suspendido',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC4455667',
                'name' => 'Laura',
                'last_name' => 'García Torres',
                'birth_date' => '1988-12-01',
                'gender' => 'femenino',
                'phone' => '555-3210-9876',
                'state_id' => $stateIds[3] ?? null,
                'city_id' => null,
                'email' => 'laura.garcia@example.com',
                'team_name' => 'Equipo Delta',
                'medical_conditions' => 'Diabetes tipo 2',
                'allergies' => 'Lácteos',
                'blood_type' => 'AB-',
                'emergency_contact_name' => 'Pedro García',
                'emergency_contact_phone' => '555-9876-5432',
                'notes' => 'Atleta retirado',
                'status' => 'inactivo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC1122334',
                'name' => 'Carlos Andrés',
                'last_name' => 'Sánchez Méndez',
                'birth_date' => '2005-07-20',
                'gender' => 'masculino',
                'phone' => '555-7890-1234',
                'state_id' => $stateIds[4] ?? null,
                'city_id' => null,
                'email' => 'carlos.sanchez@example.com',
                'team_name' => 'Equipo Elite',
                'medical_conditions' => null,
                'allergies' => null,
                'blood_type' => 'A-',
                'emergency_contact_name' => 'Carmen Méndez',
                'emergency_contact_phone' => '555-1234-7890',
                'notes' => 'Joven promesa del atletismo',
                'status' => 'activo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC5566778',
                'name' => 'Ana',
                'last_name' => 'López Fernández',
                'birth_date' => '1992-11-05',
                'gender' => 'femenino',
                'phone' => '555-2345-6789',
                'state_id' => $stateIds[0] ?? null,
                'city_id' => null,
                'email' => 'ana.lopez@example.com',
                'team_name' => 'Equipo Alpha',
                'medical_conditions' => null,
                'allergies' => 'Ninguna',
                'blood_type' => 'O-',
                'emergency_contact_name' => 'Luis López',
                'emergency_contact_phone' => '555-8765-4321',
                'notes' => null,
                'status' => 'activo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC6677889',
                'name' => 'Miguel Ángel',
                'last_name' => 'Torres Ruiz',
                'birth_date' => '1985-07-14',
                'gender' => 'masculino',
                'phone' => '555-3456-7890',
                'state_id' => $stateIds[1] ?? null,
                'city_id' => null,
                'email' => 'miguel.torres@example.com',
                'team_name' => 'Equipo Beta',
                'medical_conditions' => 'Artritis',
                'allergies' => 'Polvo',
                'blood_type' => 'AB+',
                'emergency_contact_name' => 'Sofía Torres',
                'emergency_contact_phone' => '555-7654-3210',
                'notes' => 'Veterano del equipo',
                'status' => 'activo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC7788990',
                'name' => 'Patricia',
                'last_name' => 'González Castro',
                'birth_date' => '2000-03-25',
                'gender' => 'femenino',
                'phone' => '555-4567-8901',
                'state_id' => $stateIds[2] ?? null,
                'city_id' => null,
                'email' => 'patricia.gonzalez@example.com',
                'team_name' => 'Equipo Gamma',
                'medical_conditions' => null,
                'allergies' => 'Mariscos',
                'blood_type' => 'B-',
                'emergency_contact_name' => 'Roberto González',
                'emergency_contact_phone' => '555-6543-2109',
                'notes' => 'Nueva integrante',
                'status' => 'activo',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC8899001',
                'name' => 'Fernando',
                'last_name' => 'Ramírez Díaz',
                'birth_date' => '1993-09-17',
                'gender' => 'masculino',
                'phone' => '555-5678-9012',
                'state_id' => $stateIds[3] ?? null,
                'city_id' => null,
                'email' => 'fernando.ramirez@example.com',
                'team_name' => 'Equipo Delta',
                'medical_conditions' => 'Alergia estacional',
                'allergies' => 'Polen, gramíneas',
                'blood_type' => 'A+',
                'emergency_contact_name' => 'María Ramírez',
                'emergency_contact_phone' => '555-5432-1098',
                'notes' => null,
                'status' => 'suspendido',
            ],
            [
                'photo' => 'avatar.jpg', // ✅ Foto asignada
                'document' => 'DOC9900112',
                'name' => 'Carmen',
                'last_name' => 'Mendoza Flores',
                'birth_date' => '1997-01-30',
                'gender' => 'femenino',
                'phone' => '555-6789-0123',
                'state_id' => $stateIds[4] ?? null,
                'city_id' => null,
                'email' => 'carmen.mendoza@example.com',
                'team_name' => 'Equipo Elite',
                'medical_conditions' => null,
                'allergies' => null,
                'blood_type' => 'O+',
                'emergency_contact_name' => 'Jorge Mendoza',
                'emergency_contact_phone' => '555-4321-0987',
                'notes' => 'Capitana del equipo',
                'status' => 'activo',
            ],
        ];

        foreach ($athletes as $athlete) {
            Athlete::create($athlete);
        }

        $this->command->info('✅ 10 atletas creados exitosamente con foto avatar.jpg!');
    }
}