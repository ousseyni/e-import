<?php

use App\Activite;
use App\CategorieProduit;
use App\Contribuables;
use App\DeviseEtrangere;
use App\EtatDemande;
use App\FraisDossier;
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

        Profils::create([
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
        TypeContribuables::create([
            'libelle'     => 'Exportateur',
        ]);
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
            'libelle'     => 'Dépotage',
        ]);
        Prescriptions::create([
            'code'     => 'ANA',
            'libelle'     => 'Analyse',
        ]);
        Prescriptions::create([
            'code'     => 'SAI',
            'libelle'     => 'Saisie',
        ]);
        Prescriptions::create([
            'code'     => 'DES',
            'libelle'     => 'Destruction',
        ]);
        Prescriptions::create([
            'code'     => 'REX',
            'libelle'     => 'Réexportation',
        ]);




        EtatDemande::create([
            'id'     => 1,
            'libelle_dgcc'     => "Nouvelle Demande reçue - en attente de traitement",
            'libelle_user'     => "Demande transmise à la DGCC",
            'etat_actuel'     => 1,
            'etat_suivant'     => "3-998-999",
        ]);
        EtatDemande::create([
            'id'     => 2,
            'libelle_dgcc'     => "Transmission aux agents - en attente d'étude",
            'libelle_user'     => "Demande en cours d'étude",
            'etat_actuel'     => 2,
            'etat_suivant'     => "3-998-999",
        ]);
        EtatDemande::create([
            'id'     => 3,
            'libelle_dgcc'     => "Etude terminée - en attente de confirmation",
            'libelle_user'     => "Demande en cours d'étude",
            'etat_actuel'     => 3,
            'etat_suivant'     => "4-998-999",
        ]);
        EtatDemande::create([
            'id'     => 4,
            'libelle_dgcc'     => "Confirmation terminée - en attente de validation",
            'libelle_user'     => "Demande en cours d'étude",
            'etat_actuel'     => 4,
            'etat_suivant'     => "5-8-998-999",
        ]);
        EtatDemande::create([
            'id'     => 5,
            'libelle_dgcc'     => "Validation terminée - ordre de recette à établir",
            'libelle_user'     => "Demande en cours d'étude",
            'etat_actuel'     => 5,
            'etat_suivant'     => "6",
        ]);
        EtatDemande::create([
            'id'     => 6,
            'libelle_dgcc'     => "Génération de l'ordre de recette - en attente de paiement",
            'libelle_user'     => "Demande en cours de traitement - paiement à effectuer",
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
            'libelle_dgcc'     => "Paiement confirmé - en attente de validation",
            'libelle_user'     => "Demande en cours de validation",
            'etat_actuel'     => 8,
            'etat_suivant'     => "9-998-999",
        ]);
        EtatDemande::create([
            'id'     => 9,
            'libelle_dgcc'     => 'Validation terminée - en attente de visa',
            'libelle_user'     => 'Demande en cours de signature',
            'etat_actuel'     => 9,
            'etat_suivant'     => "10-998-999",
        ]);
        EtatDemande::create([
            'id'     => 10,
            'libelle_dgcc'     => 'Visa terminé - en attente de signature',
            'libelle_user'     => 'Demande en cours de signature',
            'etat_actuel'     => 10,
            'etat_suivant'     => "11-998-999",
        ]);
        EtatDemande::create([
            'id'     => 11,
            'libelle_dgcc'     => 'Signature terminée - demande disponible',
            'libelle_user'     => 'Demande signée - téléchargeable',
            'etat_actuel'     => 11,
            'etat_suivant'     => '',
        ]);
        EtatDemande::create([
            'id' => 998,
            'libelle_dgcc'     => 'Demande rejetée - A completer/corriger',
            'libelle_user'     => 'Demande rejetée - A completer/corriger',
            'etat_actuel'     => 998,
            'etat_suivant'     => '',
        ]);
        EtatDemande::create([
            'id' => 999,
            'libelle_dgcc'     => 'Demande annulée - Refaire une nouvelle demande',
            'libelle_user'     => 'Demande annulée - Refaire une nouvelle demande',
            'etat_actuel'     => 999,
            'etat_suivant'     => '',
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
