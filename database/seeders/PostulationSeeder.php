<?php

namespace Database\Seeders;

use App\Models\Postulation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            $this->command->warn('Aucun utilisateur trouvé. Création de 5 utilisateurs fictifs.');
            User::factory()->count(5)->create();
        }

        $users = User::inRandomOrder()->take(10)->get();

        $data = [
            [
                'experiences' => "J'ai dirigé un club de débat pendant 1 an et organisé 3 événements régionaux.",
                'motivations' => "Je veux inspirer les jeunes à prendre la parole et s'engager dans leur communauté.",
                'plan' => "Créer un programme d'entraînement à la prise de parole et organiser des tournois de débat trimestriels.",
            ],
            [
                'experiences' => "Responsable logistique dans une association caritative pendant 2 ans.",
                'motivations' => "Mon objectif est d'améliorer la coordination des activités sociales dans notre établissement.",
                'plan' => "Mettre en place une plateforme de gestion de projets et organiser une collecte mensuelle.",
            ],
            [
                'experiences' => "Membre actif dans un projet de sensibilisation écologique, j’ai mené plusieurs campagnes locales.",
                'motivations' => "Je suis passionné par l’environnement et je veux initier des projets verts au sein de l'école.",
                'plan' => "Installer des poubelles de tri, lancer un club éco-responsable et organiser une journée verte.",
            ],
            [
                'experiences' => "Président d’un club de technologie, j’ai animé des ateliers sur Arduino et Python pendant 1 an.",
                'motivations' => "Je veux encourager les étudiants à s’initier aux nouvelles technologies.",
                'plan' => "Organiser des bootcamps mensuels et créer un espace maker dans l’établissement.",
            ],
            [
                'experiences' => "Volontaire dans une ONG d’aide aux réfugiés, j’ai participé à la distribution de nourriture et de vêtements.",
                'motivations' => "Je suis motivé par le service aux autres et l’impact concret sur les vies.",
                'plan' => "Créer une cellule de bénévolat local et organiser des campagnes de solidarité chaque trimestre.",
            ],
            [
                'experiences' => "J’ai coordonné une équipe de 10 personnes pour une initiative de tutorat entre étudiants.",
                'motivations' => "Je veux renforcer l’entraide académique et lutter contre l’échec scolaire.",
                'plan' => "Mettre en place un système de parrainage entre anciens et nouveaux étudiants.",
            ],
            [
                'experiences' => "Animatrice dans une colonie de vacances, j’ai géré des groupes d’adolescents et organisé des activités éducatives.",
                'motivations' => "Je veux promouvoir le développement personnel à travers des activités extrascolaires.",
                'plan' => "Lancer un programme d’ateliers créatifs et de développement de soft skills.",
            ],
            [
                'experiences' => "Participant à un hackathon national, j’ai remporté un prix pour une application d’éducation inclusive.",
                'motivations' => "Je veux mettre la technologie au service de l’égalité des chances.",
                'plan' => "Organiser des ateliers de code accessibles à tous et créer un site de partage de ressources éducatives.",
            ],
            [
                'experiences' => "Organisateur d’un événement culturel inter-établissements avec plus de 500 participants.",
                'motivations' => "Je crois au pouvoir de la culture pour créer du lien social.",
                'plan' => "Organiser un festival annuel mêlant musique, art et expression orale.",
            ],
            [
                'experiences' => "Responsable communication pour un projet humanitaire, j’ai géré les réseaux sociaux et les relations presse.",
                'motivations' => "Je veux développer la visibilité des initiatives étudiantes.",
                'plan' => "Créer une newsletter mensuelle et une plateforme pour valoriser les projets de chaque club.",
            ],

        ];

        foreach ($users as $index => $user) {
            Postulation::create([
                'president_id' => $user->id,
                'experiences' => $data[$index]['experiences'],
                'motivations' => $data[$index]['motivations'],
                'plan' => $data[$index]['plan'],
                'statut' => 'pending',
            ]);
        }
    }
}
