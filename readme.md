# BlogLaravelExample
Blog básico hecho en Laravel 5 para aprendizaje

#Sentencias SQL de prueba
select count(posts.id), users.name from posts, users where posts.user_id = users.id group by posts.id;
