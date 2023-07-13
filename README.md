
<h1 align="center" >

💜 Blog Rest API 💜

</h1>

<h2>🚀 About</h2>
<p>
A Blog Rest API, made with the <a href="https://www.slimframework.com/docs/v4/">Slim Framework 4</a>, with integration for exception handling and authentication users using jwt token.
</p>
  
<h2>🎱 Features</h2>

<ul>
  <li>Login user</li>
  <li>Register user</li>
  <li>Rename username</li>
  <li>User can delete his own account</li>
</ul>

<ul>
  <li>Catch all post</li>
  <li>ADM can add and delete post</li>
  <li>ADM can edit the title and content of a postt</li>
  <li>Route to get the content of a post, changing the markdown code to html</li>
</ul>

<ul>
  <li>Comment on a post</li>
  <li>Edit your comment of a post</li>
  <li>Delete own comment on a post</li>
</ul>

<h2>⚙ Creating database schema using a Doctrine Console command</h2>
<p>The Doctrine Console was configured in the <strong>cli-config.php</strong> file to allow the execution of Doctrine Console commands, but before executing the command to create the database schemas, it is necessary to follow some steps:
</p>
<p>
  <strong>1.</strong> You need to use the <strong>composer install</strong> command to install the required dependencies.
  
  ```
  composer install
  ```
  <strong>2.</strong> And then create a <strong>.env</strong> file using the <strong>".env.example"</strong> file as a reference.<br><br>
  <strong>3.</strong> And lastly run the command to create the database schema in the project location using a console (it is not recommended to run this command in a production environment, it is recommended to run it only in a development environment).
   
  ```
  php vendor/bin/doctrine orm:schema-tool:create
  ```
  
</p>

<h2>🛠 Technologies</h2>

<li><a href="https://jwt.io">JWT</a></li>
<li><a href="https://packagist.org/packages/ramsey/uuid">UUID</a></li>
<li><a href="https://www.mysql.com/">MySQL</a></li>
<li><a href="https://www.doctrine-project.org/projects/doctrine-orm/en/2.15/index.html">Doctrine ORM</a></li>
<li><a href="https://www.slimframework.com/docs/v4/">Slim Framework 4</a></li>
<li><a href="https://respect-validation.readthedocs.io/en/latest/">Respect Validation</a></li>


<h2>🔥 Author</h2>

| [<img src="https://avatars.githubusercontent.com/Nelson-Dominici" width=115><br><sub>Nelson Dominici</sub>](https://github.com/Nelson-Dominici) |
| :---: |
