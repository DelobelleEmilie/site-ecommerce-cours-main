<?php

function upload($file): string | null
{
    $uploads = [
        'extensions' => ['png', 'jpg'],
        'path' => 'uploads/','state' => false]
    ;

    $file_name = null;

    if (isset($file)) {
        if (!empty($file['name'])) {
            var_dump($file['name']);
            $file_upload = explode(".", $_FILES["productImage"]['name']);
            // Vérification de l'extension
            # permet de vérifier la présence d’une valeur dans un tableau.
            if (in_array($file_upload[count($file_upload) - 1],
                $uploads['extensions'])) {
                // Nettoyage des accents
                $file_name = strtr($file_upload[0],
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                // Nettoyage des caractères spéciaux
                $file_name = preg_replace('/([^.a-z0-9]+)/i', '_', $file_name);
                # permet de couper la chaine de caractères à chaque fois qu’un point sera présent.
                $file_name = $file_name . '.' .
                    $file_upload[count($file_upload) - 1];
                $file_path = $uploads['path'] . $file_name;
                #’instruction de la condition s’attarde à vérifier qu’un fichier ayant le même nom n’existe pas.
                #Si aucun fichier du même nom n’est trouvé, l’envoi de fichier est autorisé à continuer
                #Si toutes les conditionssont vérifiées,le déplacement du fichier vers ledossier «uploads» situé dans le dossier «public» est autorisé. Le déplacement s’effectue

                if (!file_exists($file_path)) {
                    // Déplacement du fichier
# l’autorisation est effectuée en passant l’état de la variable «uploads» à vrai
                    move_uploaded_file($_FILES['productImage']['tmp_name'], $file_path);
                    $uploads['state'] = true;
                } else {
                    $msg = "Une image avec ce nom existe déjà !";
                }
            } else {
                $msg = "L'extension du fichier n'est pas acceptée!";
            }
        } else {
            $msg = "Veuillez choisir un fichier !";
        }
    }

    return $file_name;
}

