<?php

use App\Activite;
use App\CategorieProduit;
use App\Contribuables;
use App\EtatDemande;
use App\ModeTransport;
use App\Pays;
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
            'libelle'     => 'Usager',
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
            'name' => 'Usager DGCC',
            'email' => 'usager@gmail.com',
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
            'libelle'     => 'Aérienne',
        ]);
        ModeTransport::create([
            'libelle'     => 'Maritime',
        ]);
        ModeTransport::create([
            'libelle'     => 'Terrestre',
        ]);
        ModeTransport::create([
            'libelle'     => 'Ferroviaire',
        ]);



        EtatDemande::create([
            'libelle_dgcc'     => 'Nouvelle Demande reçue - en attente de traitement',
            'libelle_user'     => 'Demande transmise à la DGCC',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Demande transmis pour évaluation - Agents',
            'libelle_user'     => 'Evaluation de la demande en cours à la DGCC',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Evaluation effectuée - En attente de dépôtage',
            'libelle_user'     => 'Demande en cours de traitement - Dépôtage à effectuer',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Evaluation terminée - En attente de confirmation',
            'libelle_user'     => 'Demande en cours de traitement - Dépôtage terminé',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Confirmation effectuée - En attente de paiement',
            'libelle_user'     => 'Demande en cours de traitement - Paiement à effectuer',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Paiement effectuée - En attente de validation',
            'libelle_user'     => 'Demande en cours de validation',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Validation terminée - En attente de visa',
            'libelle_user'     => 'Demande en cours de signature',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Visa terminé - En attente de signature',
            'libelle_user'     => 'Demande en cours de signature',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Signature terminée - Demande disponible',
            'libelle_user'     => 'Demande signée - Téléchargeable',
        ]);
        EtatDemande::create([
            'libelle_dgcc'     => 'Demande rejetée - Non conforme',
            'libelle_user'     => 'Demande rejetée - Non conforme',
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
