<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login / Registratie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Registreren</h2>
                <form method="post" action="form.php">
                    <input type="hidden" name="action" value="signup" />
                    <div class="mb-3">
                        <label for="signup-username" class="form-label">Gebruikersnaam</label>
                        <input type="text" class="form-control" id="signup-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="signup-email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="signup-email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="signup-password" class="form-label">Wachtwoord</label>
                        <input type="password" class="form-control" id="signup-password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registreren</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Inloggen</h2>
                <form method="post" action="form.php">
                    <input type="hidden" name="action" value="login" />
                    <div class="mb-3">
                        <label for="login-username" class="form-label">Gebruikersnaam</label>
                        <input type="text" class="form-control" id="login-username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label">Wachtwoord</label>
                        <input type="password" class="form-control" id="login-password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Inloggen</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>