<?php

use App\Activite;
use App\CategorieProduit;
use App\Contribuables;
use App\DeviseEtrangere;
use App\EtatDemande;
use App\FraisDossier;
use App\Habilitation;
use App\ModeTransport;
use App\Pays;
use App\Prescriptions;
use App\Produits;
use App\Profils;
use App\SousActivite;
use App\TypeContribuables;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function purge_uploads_folder($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                $this->purge_uploads_folder($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }

    public function run()
    {

        // On supprime chaque dossier et chaque fichier	du dossier cible
        $dossier = public_path('uploads');
        $this->purge_uploads_folder($dossier);
        mkdir($dossier, 0777, true);

        $admin = Profils::create([
            'libelle'     => 'Administrateur',
        ]);
        Profils::create([
            'libelle'     => 'Opérateur économique',
        ]);

        User::create([
            'name' => 'Admin DGCC',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'email_verified' => 1,
            'email_verification_token' => '',
            'login' => 'admin',
            'profilid' => 1,
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'name' => 'Opérateur DGCC',
            'email' => 'operateur@gmail.com',
            'email_verified_at' => Carbon::now(),
            'email_verified' => 1,
            'email_verification_token' => '',
            'login' => '070199-F',
            'profilid' => 2,
            'password' => bcrypt('070199-F'),
        ]);

        TypeContribuables::create([
            'libelle'     => 'Importateur',
        ]);
        /*TypeContribuables::create([
            'libelle'     => 'Exportateur',
        ]);*/
        TypeContribuables::create([
            'libelle'     => 'Producteur local',
        ]);

        ModeTransport::create([
            'libelle'     => 'Aérien',
        ]);
        ModeTransport::create([
            'libelle'     => 'Maritime',
        ]);
        ModeTransport::create([
            'libelle'     => 'Terrestre',
        ]);
        /*ModeTransport::create([
            'libelle'     => 'Ferroviaire',
        ]);*/


        FraisDossier::create([
            'designation'     => "Maritime",
            'valeur_int'     => 25000,
            'valeur_str'     => '',
        ]);
        FraisDossier::create([
            'designation'     => "Aérien",
            'valeur_int'     => 0,
            'valeur_str'     => '',
        ]);
        FraisDossier::create([
            'designation'     => "Terrestre",
            'valeur_int'     => 25000,
            'valeur_str'     => '',
        ]);


        DeviseEtrangere::create([
            'code'     => 'EUR',
            'libelle'     => 'Euro',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'JPY',
            'libelle'     => 'Yen Japonais',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'GBP',
            'libelle'     => 'Livre Sterling',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'AED',
            'libelle'     => 'Dirham Arabes',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'BRL',
            'libelle'     => 'Real (Brésilien)',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'CAD',
            'libelle'     => 'Dollar Canadien',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'USD',
            'libelle'     => 'Dollar Américain',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'RUB',
            'libelle'     => 'Rouble Russe',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'CNY',
            'libelle'     => 'Yuan Renminbi',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'NGN',
            'libelle'     => 'Naira',
            'taux'     => 0,
        ]);
        DeviseEtrangere::create([
            'code'     => 'ZAR',
            'libelle'     => 'Rand Sudafricano',
            'taux'     => 0,
        ]);


        Prescriptions::create([
            'code'     => 'RAS',
            'libelle'     => 'Rien à signaler',
        ]);
        Prescriptions::create([
            'code'     => 'DEP',
            'libelle'     => 'A inspecter',
        ]);
        Prescriptions::create([
            'code'     => 'ANA',
            'libelle'     => 'A analyser',
        ]);
        Prescriptions::create([
            'code'     => 'SAI',
            'libelle'     => 'A saisir',
        ]);
        Prescriptions::create([
            'code'     => 'DES',
            'libelle'     => 'A détruire',
        ]);
        Prescriptions::create([
            'code'     => 'REX',
            'libelle'     => 'A réexporter',
        ]);




        EtatDemande::create([
            'id'     => 1,
            'libelle_dgcc'     => "Nouveau dossier reçu - en attente de traitement",
            'libelle_user'     => "Dossier envoyé à la DGCC",
            'etat_actuel'     => 1,
            'etat_suivant'     => "3-998-999",
        ]);
        EtatDemande::create([
            'id'     => 2,
            'libelle_dgcc'     => "Dossier transmis aux agents - en attente d'étude",
            'libelle_user'     => "Dossier en cours d'étude",
            'etat_actuel'     => 2,
            'etat_suivant'     => "3-998-999",
        ]);
        EtatDemande::create([
            'id'     => 3,
            'libelle_dgcc'     => "Etude terminée - en attente de validation",
            'libelle_user'     => "Dossier en cours d'étude",
            'etat_actuel'     => 3,
            'etat_suivant'     => "4-998-999",
        ]);
        EtatDemande::create([
            'id'     => 4,
            'libelle_dgcc'     => "Validation terminée - en attente de visa",
            'libelle_user'     => "Dossier en cours d'étude",
            'etat_actuel'     => 4,
            'etat_suivant'     => "5-9-998-999",
        ]);
        EtatDemande::create([
            'id'     => 5,
            'libelle_dgcc'     => "Visa terminé - ordre de recette à établir",
            'libelle_user'     => "Etablissement de l'ordre de recette en cours",
            'etat_actuel'     => 5,
            'etat_suivant'     => "6",
        ]);
        EtatDemande::create([
            'id'     => 6,
            'libelle_dgcc'     => "Génération de l'ordre de recette - en attente de paiement",
            'libelle_user'     => "Ordre de recette disponible - paiement à effectuer",
            'etat_actuel'     => 6,
            'etat_suivant'     => "7-998-999",
        ]);
        EtatDemande::create([
            'id'     => 7,
            'libelle_dgcc'     => "Paiement effectué - en attente de confirmation",
            'libelle_user'     => "Paiement en cours de vérification",
            'etat_actuel'     => 7,
            'etat_suivant'     => "8-998-999",
        ]);
        EtatDemande::create([
            'id'     => 8,
            'libelle_dgcc'     => "Paiement confirmé - en attente de signature",
            'libelle_user'     => "Paiement confirmé _ en cours de signature",
            'etat_actuel'     => 8,
            'etat_suivant'     => "10-998-999",
        ]);
        EtatDemande::create([
            'id'     => 9,
            'libelle_dgcc'     => 'Visa terminé - en attente de signature',
            'libelle_user'     => 'Dossier en cours de signature',
            'etat_actuel'     => 9,
            'etat_suivant'     => "10-998-999",
        ]);
        EtatDemande::create([
            'id'     => 10,
            'libelle_dgcc'     => 'Signature terminée - documents disponibles',
            'libelle_user'     => 'Dossier signé - documents téléchargeables',
            'etat_actuel'     => 10,
            'etat_suivant'     => '',
        ]);
        EtatDemande::create([
            'id' => 998,
            'libelle_dgcc'     => 'Dossier rejeté - incomplet',
            'libelle_user'     => 'Dossier rejeté - incomplet',
            'etat_actuel'     => 998,
            'etat_suivant'     => '',
        ]);

        EtatDemande::create([
            'id' => 999,
            'libelle_dgcc'     => 'Dossier traité - en infraction',
            'libelle_user'     => 'Dossier traité - en infraction',
            'etat_actuel'     => 999,
            'etat_suivant'     => 9991,
        ]);
        EtatDemande::create([
            'id' => 9991,
            'libelle_dgcc'     => "Infraction levée - Génération de l'ordre de recette",
            'libelle_user'     => "Infraction levée - Génération de l'ordre de recette",
            'etat_actuel'     => 9991,
            'etat_suivant'     => 6,
        ]);



        $file = public_path('init_files/contribuables.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $contribuable_old = Contribuables::where('nif', '=', $data[0])->first();
                if ($contribuable_old) {
                    $contribuable_old->raisonsociale = $data[1];
                    $contribuable_old->nomprenom = $data[2];
                    $contribuable_old->save();
                }
                else {
                    $contribuable_new = new Contribuables();
                    $contribuable_new->nif = $data[0];
                    $contribuable_new->raisonsociale = $data[1];
                    $contribuable_new->nomprenom = $data[2];
                    $contribuable_new->save();
                }
            }
        }
        fclose($handle);


        $file = public_path('init_files/all_habilitations.csv');
        $row = 0;
        $handle = fopen($file, "r");
        $tab_droit = array();
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $droit = new Habilitation();
                $droit->libelle = $data[0];
                $droit->categorie = $data[1];
                $droit->save();

                $tab_droit[] = $droit->id;
            }
        }
        fclose($handle);

        $droits = Habilitation::find($tab_droit);
        $admin->getHabilitations()->attach($droits);


        $file = public_path('init_files/pays.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $pays = new Pays();
                $pays->libelle = $data[1];
                $pays->save();
            }
        }
        fclose($handle);



        $file = public_path('init_files/all_activities.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $activite = new Activite();
                $activite->code = $data[0];
                $activite->libelle = $data[1];
                $activite->save();
            }
        }
        fclose($handle);



        $file = public_path('init_files/all_sous_activities.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $activite = Activite::where('code', '=', $data[2])->firstOrFail();

                $sous_activite = new SousActivite();
                $sous_activite->code = $data[0];
                $sous_activite->libelle = $data[1];
                $sous_activite->activiteid = $activite->id;
                $sous_activite->save();
            }
        }
        fclose($handle);



        $file = public_path('init_files/all_categories.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $cat_produit = new CategorieProduit();
                $cat_produit->code = $data[0];
                $cat_produit->libelle = $data[1];
                $cat_produit->type = $data[2];
                $cat_produit->save();
            }
        }
        fclose($handle);



        $file = public_path('init_files/all_produits.csv');
        $row = 0;
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

                $row++;
                if($row == 1) continue;
                $data = array_map("utf8_encode", $data); //added

                $cat_produit = CategorieProduit::where('code', '=', $data[2])->firstOrFail();

                $produit = new Produits();
                $produit->code = $data[0];
                $produit->libelle = $data[1];
                $produit->montant = $data[3];
                $produit->categorie_produit_id = $cat_produit->id;
                $produit->type = $data[4];
                $produit->save();
            }
        }
        fclose($handle);

    }
}
