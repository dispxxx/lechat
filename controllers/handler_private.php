<?php
    if(isset($_POST['action'])){


        //Recept message
        if($_POST['action'] == 'recept'){
            $query = "SELECT  date_sent, content, id_recipient, id_sender, recipient.name AS name_recipient, sender.name AS name_sender
                          FROM private
                          LEFT JOIN user recipient ON private.id_recipient = recipient.id
			              LEFT JOIN user sender ON private.id_sender = sender.id
                          WHERE
                            CASE
                              WHEN id_recipient = " . $_SESSION['id'] . " THEN id_sender = ".intval($_POST['other_id'])."
                              WHEN id_sender = " . $_SESSION['id'] . " THEN id_recipient = ".intval($_POST['other_id'])."
                            END";
            if ($data = mysqli_query($db, $query)) {

                while ($result = mysqli_fetch_assoc($data)) {
                    ?>
                    <p>
                        <em><?php echo date('G:i', strtotime($result['date_sent'])); ?></em>
                        <strong>@<?php echo htmlentities($result['name_sender']); ?></strong>
                        : <?php echo htmlentities($result['content']); ?>
                    </p>
                    <?php
                }
            } else {
                $errors[] = "db connect pb";
            }
            exit;
        }


        // Send action
        if ($_POST['action'] == 'send')
        {
            if (isset($_POST['message_content']))
            {
                $message_content = mysqli_real_escape_string($db, $_POST['message_content']);

                $query = "	INSERT INTO private(id_sender, id_recipient, content)
						    VALUES(".$_SESSION['id'].", ".intval($_POST['other_id'])." ,'".$message_content."')";

                if($data = mysqli_query($db, $query))
                {
                    $success = "Votre message a bien été envoyé!";
                }
                else
                {
                    $errors[]= "Une erreur est survenu, merci de recommencer!";
                }
                exit;
            }
        }



    }