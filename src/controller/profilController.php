<?php


function deleteUser($db, $id)
{
    if (isset($_POST['delete_item'])) {
        $query = $db->prepare("DELETE FROM shop_users WHERE id=:id");
        $query->execute(['id' => $id]);
        if ($query->rowCount() > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}

function password()
{
    if (!empty($_POST)) {
        ;
        $password = $_POST['password'] ?? null;
        $passwordConfirm = $_POST['new_mot_passe'] ?? null;

        $form['values'] = [
            'new_mot_passe' => $passwordConfirm,
        ];
    }
    if ($passwordConfirm === $passwordConfirm and $_POST["ancien_mot_passe"] == $password) {
        saveUser(saveUserpassword_hash($passwordConfirm, PASSWORD_DEFAULT));
        $form['state'] = 'success';
        $form['message'] = 'Vous avez change votre mot de base!';
    }

    else
    {
        $form['state'] = 'danger';
        $form['message'] = 'Les mots de passe ne correspondent pas ';
    }
    header("Location: index.php");
    die();
}