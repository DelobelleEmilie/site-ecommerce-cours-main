<?php
#implante le fichier ProductModel
include_once '../src/model/ProductModel.php';
include_once '../src/model/CategoryModel.php';




#Si on saisis le formulaire $_POST contient les données ducoup les produit s'enregistre et raffiche le formulaire vide
function addProductController($twig, $db)
{
  include_once '../src/model/ProductModel.php';
    $categories = getAllCategories();
    #variable de type tableau que nous allons utiliser pour paramétrer l’envoi de fichier.
    $uploads = [
        #clé «extensions» permettant de lister l’ensemble des extensions des fichiers qui sont autoriséesà être envoyées
        'extensions' => ['png', 'jpg'],
        'path' => 'uploads/','state' => false
    ];
    #défaut défini à «null»
    $file_name = null;
  #Une variable «$form» est créée et définie en tant que tableau vide «[]»
  $form = [];
  if (isset($_POST['btnAddProduct'])) {
    $label = htmlspecialchars($_POST['productLabel']);
    $description = htmlspecialchars($_POST['productDescription']);
    $price = htmlspecialchars($_POST['productPrice']);
    if (empty($price)) {
      $price = 0.00;
    }
    $category = htmlspecialchars($_POST['productCategory']);
    ##vérifie qu’une image est bien envoyée
      if (isset($_FILES["productImage"]))
      {
          if (!empty($_FILES["productImage"]['name'])) {$file_upload = explode(".", $_FILES["productImage"]['name']);
              // Vérification de l'extension
              # permet de vérifier la présence d’une valeur dans un tableau.
              if (in_array($file_upload[count($file_upload) -1],
                  $uploads['extensions'])) {
                  // Nettoyage des accents
                  $file_name = strtr($file_upload[0],
                      'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                  // Nettoyage des caractères spéciaux
                  $file_name = preg_replace('/([^.a-z0-9]+)/i', '_', $file_name);
                  # permet de couper la chaine de caractères à chaque fois qu’un point sera présent.
                  $file_name = $file_name . '.' .
                      $file_upload[count($file_upload) -1];
                  $file_path = $uploads['path'] . $file_name
                      #’instruction de la condition s’attarde à vérifier qu’un fichier ayant le même nom n’existe pas.
                  #Si aucun fichier du même nom n’est trouvé, l’envoi de fichier est autorisé à continuer
                  #Si toutes les conditionssont vérifiées,le déplacement du fichier vers ledossier «uploads» situé dans le dossier «public» est autorisé. Le déplacement s’effectue

                  if (!file_exists($file_path)) {
                      // Déplacement du fichier
# l’autorisation est effectuée en passant l’état de la variable «uploads» à vrai
                      move_uploaded_file($_FILES['productImage']['tmp_name'], $file_path);
                      $uploads['state'] = true;} else {$msg = "Une image avec ce nom existe déjà !";
                  }} else
                  {$msg = "L'extension du fichier n'est pas acceptée!";
                  }} else
                  {$msg = "Veuillez choisir un fichier !";
          }}
                  }
              }
              if (empty($label) || empty($description) || empty($category)) {
                {
                  #la variable «$form» se constitue d’une clé «state» pour définir l’état du formulaire.
                  #Le tableau est aussi constitué d’une clé «message» danslaquelle nous renseignerons un message personnalisé pour informer l’utilisateur
                  $form = [
                      'state' => 'danger',
                      'message' => [$msg]
 
                  ];
                  saveProduct($db, $label, $description, $price, $category, $file_name);

                  #la variable «$form» est complétéeavec des informations que nous pourrons réutiliser dans la vue Twig.
                  echo $twig->render('form_addproduct.html.twig', [
                      #la variable «$form» est passée à la vue Twig sous le nom «form»
                      'form' => $form,
                      'page'=>"?page=addProduct"
                  ]);
#sinon le produit est sauvergardée
              }
                  else {
                      $form= [
                            if ($uploads['state']){
                                $form=[
                                'state' => "success",
                            'message' => "Votre produit a bien était ajoute"
    ];
          echo $twig->render('form_addproduct.html.twig', [
              'form' => $form
          ]);
      }
                            }
}
