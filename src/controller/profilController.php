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
        $passwordConfirm = $_POST['new_mot_passe'] ?? null ;

        $form['values'] = [
            'new_mot_passe' => $passwordConfirm,
    ];
    }
    if ($passwordConfirm === $passwordConfirm and $_POST["ancien_mot_passe"]  ==  $password   )
    {
        $form['state'] = 'sucess';
    }
    else
    {
        $form['state'] = 'danger';
        $form['message'] = 'Les mots de passe ne correspondent pas ';
    }
    header("Location: /");
    die();
}