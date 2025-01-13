<?php $templateParams["js"][] = "account.js"; ?>

<div class="container">
    <?php if (isset($templateParams["error"])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $templateParams["error"]; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="row">
        <section class="col-3">
            <h2><?php echo $templateParams['userInfo'][0]['name']; ?></h2>
            <p class="h3"><?php echo $templateParams['userInfo'][0]['email']; ?></p>
        </section>
        <section class="col-9">
            <h2>Personal Information</h2>
            <form method="POST" action="?page=account">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="name">Name:</label>
                            <input class="card-body form-control" type="text" id="name" name="name"
                                value="<?php echo $templateParams['userInfo'][0]['name']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['name']; ?>" disabled />
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="surname">Surname:</label>
                            <input class="card-body form-control" type="text" id="surname" name="surname"
                                value="<?php echo $templateParams['userInfo'][0]['surname']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['surname']; ?>"
                                disabled />
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="username">Userame:</label>
                            <input class="card-body form-control" type="text" id="username" name="username"
                                value="<?php echo $templateParams['userInfo'][0]['username']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['username']; ?>"
                                disabled />
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="email">E-mail:</label>
                            <input class="card-body form-control" type="text" id="email" name="email"
                                value="<?php echo $templateParams['userInfo'][0]['email']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['email']; ?>" disabled />
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="birthday">Birthday:</label>
                            <input class="card-body form-control" type="date" id="birthday" name="birthday"
                                value="<?php echo $templateParams['userInfo'][0]['birthday']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['birthday']; ?>"
                                disabled />
                        </div>
                    </div>
                    <!-- Card 6 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="card_number">Card number:</label>
                            <input class="card-body form-control" type="text" id="card_number" name="card_number"
                                value="<?php echo $templateParams['userInfo'][0]['card_number']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['card_number']; ?>"
                                disabled />
                        </div>
                    </div>
                    <!-- Card 7 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="password">Password:</label>
                            <input class="card-body form-control" type="password" id="password" name="password"
                                value="<?php echo $templateParams['userInfo'][0]['password']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['password']; ?>"
                                disabled />
                        </div>
                    </div>
                    <!-- Card 8 -->
                    <div class="col-md-6">
                        <div class="card mb-3 bg-purple-mid">
                            <label class="card-header form-label" for="confirmPassword">Confirm password:</label>
                            <input class="card-body form-control" type="password" id="confirmPassword"
                                name="confirmPassword"
                                value="<?php echo $templateParams['userInfo'][0]['password']; ?>"
                                data-original-value="<?php echo $templateParams['userInfo'][0]['password']; ?>" />
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary bg-light-purple border-0 text-purple">Edit</button>
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </section>
    </div>
</div>