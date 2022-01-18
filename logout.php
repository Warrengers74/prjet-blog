<?php
session_start();
session_destroy();
echo 'Vous avez été déconnecté. <a href="/projet-blog/login">Se connecter</a>';