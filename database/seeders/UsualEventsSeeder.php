<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsualEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Jour de l\'An',
                'description' => 'Célébration du Nouvel An',
                'start' => '2024-01-01 00:00:00',
                'end' => '2024-01-01 23:59:59',
            ],
            [
                'title' => 'Jour de l\'Indépendance du Bénin',
                'description' => 'Fête de l\'Indépendance du Bénin',
                'start' => '2024-08-01 00:00:00',
                'end' => '2024-08-01 23:59:59',
            ],
            [
                'title' => 'Noël',
                'description' => 'Fête de Noël',
                'start' => '2024-12-25 00:00:00',
                'end' => '2024-12-25 23:59:59',
            ],
            [
                'title' => 'Fête du Travail',
                'description' => 'Célébration de la Fête du Travail',
                'start' => '2024-05-01 00:00:00',
                'end' => '2024-05-01 23:59:59',
            ],
            [
                'title' => 'Journée Internationale des Femmes',
                'description' => 'Célébration de la Journée Internationale des Femmes',
                'start' => '2024-03-08 00:00:00',
                'end' => '2024-03-08 23:59:59',
            ],
            [
                'title' => 'Journée de la Santé et Sécurité au Travail',
                'description' => 'Sensibilisation à la Santé et Sécurité au Travail',
                'start' => '2024-04-28 00:00:00',
                'end' => '2024-04-28 23:59:59',
            ],
            [
                'title' => 'Journée Internationale de la Famille',
                'description' => 'Célébration de la Famille',
                'start' => '2024-05-15 00:00:00',
                'end' => '2024-05-15 23:59:59',
            ],
            [
                'title' => 'Journée Mondiale sans Tabac',
                'description' => 'Sensibilisation contre le Tabac',
                'start' => '2024-05-31 00:00:00',
                'end' => '2024-05-31 23:59:59',
            ],
            [
                'title' => 'Journée Mondiale de l\'Environnement',
                'description' => 'Célébration de l\'Environnement',
                'start' => '2024-06-05 00:00:00',
                'end' => '2024-06-05 23:59:59',
            ],
            [
                'title' => 'Journée Internationale des Coopératives',
                'description' => 'Célébration des Coopératives',
                'start' => '2024-07-06 00:00:00',
                'end' => '2024-07-06 23:59:59',
            ],
            [
                'title' => 'Journée Internationale de la Jeunesse',
                'description' => 'Célébration de la Jeunesse',
                'start' => '2024-08-12 00:00:00',
                'end' => '2024-08-12 23:59:59',
            ],
            [
                'title' => 'Journée Mondiale des Enseignants',
                'description' => 'Célébration des Enseignants',
                'start' => '2024-10-05 00:00:00',
                'end' => '2024-10-05 23:59:59',
            ],
            [
                'title' => 'Journée Mondiale de la Santé Mentale',
                'description' => 'Sensibilisation à la Santé Mentale',
                'start' => '2024-10-10 00:00:00',
                'end' => '2024-10-10 23:59:59',
            ],
            [
                'title' => 'Journée Internationale pour l\'Élimination de la Violence à l\'Égard des Femmes',
                'description' => 'Sensibilisation contre la Violence à l\'Égard des Femmes',
                'start' => '2024-11-25 00:00:00',
                'end' => '2024-11-25 23:59:59',
            ],
            [
                'title' => 'Journée Internationale des Migrants',
                'description' => 'Célébration des Migrants',
                'start' => '2024-12-18 00:00:00',
                'end' => '2024-12-18 23:59:59',
            ],
            [
                'title' => 'Noël',
                'description' => 'Célébration de Noël',
                'start' => '2024-12-25 00:00:00',
                'end' => '2024-12-25 23:59:59',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
