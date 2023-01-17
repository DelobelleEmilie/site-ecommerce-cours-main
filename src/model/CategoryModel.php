<?php

#la fonction pour tout les produits
function getallCategory($db)
#la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
/*query = db qui prepare la selection de l'id, le label,...
qui provienne de la classse shop ou la cle primare est id et est défini par where*/
{
    $query = $db->prepare("SELECT id, label FROM shop_category");
#On récupères tout les résultats de la requete et stocker le resultat dans la variable product
    $category=$query->fetchall();
/* On récupères touts résultats de la requete et stocker le resultat dans la variable product et retourner le resultat*/
return $query->fetchall();
}

#la fonction permet de sauvergarde product avec les données db,label,...
function saveCategory($db,$id,$label) 
{
    #la fonction query combine à la fois l'exécution de la requête et la mise en mémoire tampon du jeu de résultats
/*query = db qui prepare l'insersertion des données dans la base shop_product*/
# value = valeur de label, descr,...
    $query = $db->prepare("INSERT INTO shop_category (label,id )VALUE(:label,:id)");
   #retourne le résultat et implanter des routes pour les données
    return $query->execute([
        'label' => $label,
        'id' => $id,
    ]);
}