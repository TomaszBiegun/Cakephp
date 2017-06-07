<p style="margin: 0;font-size: 14px;line-height: 17px">


    Wiadomość od: <b><?php echo $this->viewVars['name']; ?> </b>
    <br>
    E-mail użytkownika: <?php echo $this->viewVars['mail']; ?>
    <br>
    Treść: <br>
    <br>
        <?php echo $this->viewVars['content']; ?>
    <br>

        <span
            style="height: 40px; line-height: 40px; padding-left: 5px; margin-left: -5px; text-align: center; border: solid 1px rgba(68, 68, 68, 0.5); background: #61c134; display: block; border-radius: 0px;opacity:0.8;">
			<a href="<?php echo $this->viewVars['link']; ?>"
               style="display: block;font-weight: bold; color: #fff; text-decoration: none;"> Przejdź do strony
                głownej </a>
            </span>

</p>