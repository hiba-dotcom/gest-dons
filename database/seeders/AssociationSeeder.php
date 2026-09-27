<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postulationIds = DB::table('postulations')->pluck('id')->toArray();

        if (empty($postulationIds)) {
            $this->command->warn("No postulations found. Seed postulations first.");
            return;
        }

        $associations = [
            [
                'nom' => 'Jeunes Innovateurs Maroc',
                'description' => 'Association dédiée à encourager l’innovation et l’entrepreneuriat chez les jeunes au Maroc.',
                'slogan' => 'Innover pour un avenir meilleur',
                'totaleMembres' => 120,
                'totaleBudget' => 75000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/FGtZw2g3TxyU_7ufSojUlgdNDdGyBlYxI9quibLYF94/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vdnFfaUlj/WTJ5NFl0Z0g3UEFx/UTI5LURyT1Rocm1D/VTlXSm1OQkpaOWdF/by9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk1U/SXcvTWpBNU16QXlN/aTl3YUc5MC9ieTkw/YUdVdFkyOXVZMlZ3/L2RDMXZaaTExYm1s/MGVTMWovYjI5d1pY/SmhkR2x2YmkxMC9a/V0Z0ZDI5eWF5MWhi/bVF0L1kyaGhjbWww/ZVM1cWNHY18vY3ow/Mk1USjROakV5Sm5j/OS9NQ1pyUFRJd0pt/TTlkR0V4L09URTFU/WFV4YVhaUVlXODEv/WjBsRk5UZE9VMFUw/WkdkWC9kRlpVYjNK/bVpuWnFSVkpNL2JG/aHhORDA.jpeg'
            ],
            [
                'nom' => 'Éco Action Casablanca',
                'description' => 'Organisation engagée dans la protection de l’environnement urbain à Casablanca.',
                'slogan' => 'Pour une ville plus verte',
                'totaleMembres' => 85,
                'totaleBudget' => 43000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/KoO0TSRjDctQqU_El6jXxcal8bL_3rZTC9Jz-3ZYWP8/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vbXhobmVu/a1VoQVB0MnlxYWhu/TVhXUGZZUVY2UTN1/NTlTOF9wX25Cb2hR/NC9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk5U/TTEvTWpBeE1EUXpM/M0JvYjNSdi9MMkox/YzJsdVpYTnpiV0Z1/L0xYUm9jbTkzYVc1/bkxXTnYvYm1abGRI/UnBMV2x1TFhSby9a/UzFoYVhJdWFuQm5Q/M005L05qRXllRFl4/TWlaM1BUQW0vYXow/eU1DWmpQV2xvTkd4/Ri9ORFJQUW1oSlZH/TnFSRUpsL1NuRnZW/MlZDU3pOalIzRnYv/Y0RWUFYxVnRaMjVU/YUVZeC9SMDA5.jpeg'
            ],
            [
                'nom' => 'Solidarité Femmes Maroc',
                'description' => 'Soutien aux droits et à l’émancipation des femmes dans toutes les régions du pays.',
                'slogan' => 'Force et unité au féminin',
                'totaleMembres' => 95,
                'totaleBudget' => 54000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/B1WtE8WfFFUihOkZo0ehFVz-zsL4t-LLOjATSvjtZfc/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vcEdsLW9l/LWQwUkVQR0ZyV0tm/QV9QbGlMLTZoWnh4/TWxhY2RBYUpQaUVu/OC9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk1U/TXkvTVRrMk5UQTFO/Qzl3YUc5MC9ieTl1/WlhSM2IzSnJMVzlt/L0xXbHVkR1Z5WTI5/dWJtVmovZEdWa0xY/QmxiM0JzWlMxcC9i/blJsY21GamRHbHZi/bk10L1ltVjBkMlZs/YmkxbGJYQnMvYjNs/bFpYTXRZVzVrTFhk/di9jbXRwYm1jdFoz/SnZkWEJ6L0xYTnZZ/MmxoYkM1cWNHY18v/Y3owMk1USjROakV5/Sm5jOS9NQ1pyUFRJ/d0ptTTlkMHhmL1pt/OTVWak5hWHpsbFlX/bEkvWWxOWVlVUlNk/M0k0Um5Ocy9kbUk0/ZVhodmFHVm5VVGN3/L1RuSkdPRDA.jpeg'
            ],
            [
                'nom' => 'Sport pour Tous',
                'description' => 'Promotion du sport amateur et des activités physiques pour toutes les tranches d’âge.',
                'slogan' => 'Bouger pour vivre mieux',
                'totaleMembres' => 150,
                'totaleBudget' => 60000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/f7S1KsliVn-8ALoa_ULNBrLKWHwtTW67EWmV-vl-ppc/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vR285WW9s/djVHa0VQcjFIa09P/OXhKWEpWa3JtaGFS/SjhUWm9Od3RRNFBt/US9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk9U/QXkvT1RJeU5ETTRM/M0JvYjNSdi9MM04w/WVc1a2FXNW5MVzkx/L2RDMW1jbTl0TFhS/b1pTMWovY205M1pD/MTNhWFJvTFhOdC9h/V3hwYm1jdGMzQm9a/WEpsL0xtcHdaejl6/UFRZeE1uZzIvTVRJ/bWR6MHdKbXM5TWpB/bS9ZejFSVW1zMU4z/bHhiMFpPL09IcEVh/SGsxTjI5SGNsRTUv/ZWtObmFIWkVjblF3/T0RWcy9iRlpUV21w/ME4xWmpQUQ.jpeg'
            ],
            [
                'nom' => 'Culture et Patrimoine',
                'description' => 'Valorisation et préservation du patrimoine culturel marocain à travers des événements locaux.',
                'slogan' => 'Racines et traditions vivantes',
                'totaleMembres' => 60,
                'totaleBudget' => 30000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/m1CP3Gd6Ptr7WjbCJSLh_Rs-NcbQ4kF3X8800pR3NQY/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vZkRYNWc4/b2g2RDFtTEYzUElY/bTdMNjFSa19UZXBu/TWpSem1ENGVrOFYz/WS9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk1U/QTIvT0RZeE9EWTVN/aTltY2k5dy9hRzkw/Ynk5amIyNWpaWEIw/L0xXUmxMWElsUXpN/bFFUbHovWldGMUxX/UmxiblJ5WlhCeS9h/WE5sTG1wd1p6OXpQ/VFl4L01uZzJNVElt/ZHowd0ptczkvTWpB/bVl6MUVkbTh0TVda/TS9aR1E0VTFFeFlW/aDFjbXhZL1FtNUxS/bmx1VVcxTlJEUTUv/Tkd4VFdrRjNZMFZ0/UzJjNC9QUQ.jpeg'
            ],
            [
                'nom' => 'Jeunesse Solidaire',
                'description' => 'Mobilisation des jeunes pour des actions sociales et humanitaires dans les zones rurales.',
                'slogan' => 'Ensemble pour changer',
                'totaleMembres' => 110,
                'totaleBudget' => 52000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/wjDUKFw8hq0QuQdDenev5N5K60JcwdLjE40vV4YiRKI/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vdEpuVFda/eUdkOTRCamRXNVFo/N3NkU0ZMZENtVDEx/dFd1LTc3dFgybWZL/Yy9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVuWlhS/MGVXbHRZV2RsL2N5/NWpiMjB2YVdRdk1U/UTUvTmpNM09EZzFO/aTltY2k5dy9hRzkw/Ynk5aFptWnBZMmho/L1oyVXRaSFV0YzIx/aGNuUncvYUc5dVpT/MXdaVzVrWVc1MC9M/V3hoTFdOdmJtWWxR/ek1sL1FUbHlaVzVq/WlM1cWNHY18vY3ow/Mk1USjROakV5Sm5j/OS9NQ1pyUFRJd0pt/TTlZMFZQL2NEaENR/V2g2U21OalpTMXgv/YWpsemEzazNRamRH/T0U0eC9Ua2xYUVVW/T1ZTMDFVVXhDL2RX/OXNPRDA.jpeg'
            ],
            [
                'nom' => 'Tech Maroc',
                'description' => 'Encouragement à la formation et au développement des compétences dans le secteur technologique.',
                'slogan' => 'Innover, créer, transformer',
                'totaleMembres' => 130,
                'totaleBudget' => 82000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/irK5B3xLJV6Zgj4BwO31K2FxHgvL1WTrlqQODVt76Hk/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vTmZuOVhX/NW4zVjF3Q2RhR0Js/bXRPZmFzM2Z6bVhP/STlrbTR0YjliZUdZ/WS9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk1U/STEvTWpNNE1qTXpN/Qzl3YUc5MC9ieTlq/YjIxdGRXNXBkSGt0/L2FYTXRjM1J5Wlc1/bmRHZ3QvYzJsbmJp/NXFjR2NfY3owMi9N/VEo0TmpFeUpuYzlN/Q1pyL1BUSXdKbU05/YVVvelVUQjUvY0RW/eVVHcEZWVlZsYVhW/VC9aV2MzU0U1TFRE/RmxSRE52L1ZEQkxS/WGt3Ym0wMGFraEov/TUQw.jpeg'
            ],
            [
                'nom' => 'Mouvement Citoyen',
                'description' => 'Engagement pour la démocratie, la transparence et la participation citoyenne.',
                'slogan' => 'La voix du peuple',
                'totaleMembres' => 70,
                'totaleBudget' => 40000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/TjT1H3x3_nThpPrip1eBi7tenCUPYC8bRBoYXHeJuyI/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vMzktM2R4/UUU0UFRVUnBBSVZ6/c25laC1pTUtzelRa/UHpPNkZhejJUOTJD/VS9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVuWlhS/MGVXbHRZV2RsL2N5/NWpiMjB2YVdRdk1U/UXovTlRZMk1UazJP/UzltY2k5dy9hRzkw/Ynk5bmNtOXpMWEJz/L1lXNHRaR1Z1Wm1G/dWRITXQvZEdWdVlX/NTBMWFZ1WlMxdy9i/R0Z1SlVNekpVRTRk/R1V0L0pVTXpKVUV3/TFd4aExYQnMvWVdk/bExtcHdaejl6UFRZ/eC9NbmcyTVRJbWR6/MHdKbXM5L01qQW1Z/ejB3UTA5ZlRXdEUv/YUdWWWF6TlNlRWhZ/U1VGci9Za2xhZVRW/b2JYTTRTWGx5L1Mw/SjRhRmR3YlhSNmRW/ZFIvUFE.jpeg'
            ],
            [
                'nom' => 'Arts et Créations',
                'description' => 'Encourager les talents artistiques locaux par des ateliers et des expositions.',
                'slogan' => 'Exprimez votre créativité',
                'totaleMembres' => 55,
                'totaleBudget' => 25000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/1ZotUpfRUyLBD_pBDis96bJ8xQ2xyhHnOYPtGarGTn0/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vcEpMeGFz/UUYwQ0JiS095U1Z0/dzRUa1FLaHpiSnBh/UGxMUXdGY0NmVFpv/WS9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk1U/RTQvTXpBMU5Ea3lO/Uzl3YUc5MC9ieTlz/WldGa1pYSnphR2x3/L0xXTnZibU5sY0hR/dGQybDAvYUMxM2Iy/OWtaVzR0WW14di9Z/MnN1YW5CblAzTTlO/akV5L2VEWXhNaVoz/UFRBbWF6MHkvTUNa/alBVczFkMUpEZVRa/cS9Uamw2YUhSRFFX/TjZNMnRmL1ZHMVlV/elkxTUVkMWVGRnkv/TlU1dk5uUklkVkE1/Tm1NOQ.jpeg'
            ],
            [
                'nom' => 'Aide et Partage',
                'description' => 'Association caritative aidant les familles dans le besoin à travers tout le Maroc.',
                'slogan' => 'Partager pour mieux vivre',
                'totaleMembres' => 140,
                'totaleBudget' => 90000,
                'postulation_id' => $postulationIds[array_rand($postulationIds)],
                'image' => 'https://imgs.search.brave.com/LofWJrkTQ4V9exwd7mkF4mgxU6KvWrcvFuW0ix8hurc/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9pbWdz/LnNlYXJjaC5icmF2/ZS5jb20vRkp1ci1V/U2RxRWNianhraXVE/Q2FkbVU0TEZSdVlC/V2szSWw3NnZfWEh4/cy9yczpmaXQ6NTAw/OjA6MDowL2c6Y2Uv/YUhSMGNITTZMeTl0/WldScC9ZUzVwYzNS/dlkydHdhRzkwL2J5/NWpiMjB2YVdRdk9E/VTMvTVRRMk1Ea3lM/Mlp5TDNCby9iM1J2/TDIxaGNpVkRNeVZC/L09XVXRaR1V0YldG/cGJuTXQvZEdWdVpI/VmxjeTVxY0djXy9j/ejAyTVRKNE5qRXlK/bmM5L01DWnJQVEl3/Sm1NOWMzWksvU0Rs/R2JXZFpVRzVzZG1a/di9TRWgzYWxOUFdY/Qm9lVWxTL01ITXdl/bGxYYVZFeU1tUm4v/VjFJNFp6MA.jpeg'
            ],
        ];

        foreach ($associations as $assoc) {
            $assoc['created_at'] = now();
            $assoc['updated_at'] = now();
        }

        DB::table('associations')->insert($associations);
    }
}
