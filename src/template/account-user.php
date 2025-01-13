<?php $templateParams["js"][] = "account.js"; ?>
<div class="container">
    <?php if (isset($templateParams["error"])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $templateParams["error"]; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="row">
        <section class="col-12 col-md-3 mb-3">
            <h2 class="text-center"><?php echo $templateParams['userInfo'][0]['name']; ?></h2>
            <p class="h3 mb-5 text-center"><?php echo $templateParams['userInfo'][0]['email']; ?></p>
            <div class="m-4 text-center">
                <a href="?page=cart" class="text-decoration-none">
                    <div class="card p-2 shadow-sm rounded-lg">
                        <h3>Shopping Cart</h3>
                    </div>
                </a>
            </div>

            <div class="m-4 text-center">
                <a href="?page=orders" class="text-decoration-none">
                    <div class="card p-2 shadow-sm rounded-lg">
                        <h3>Order History</h3>
                    </div>
                </a>
            </div>
        </section>
        <section class="col-12 col-md-9">
            <h2>Personal Information</h2>
            <form method="POST" action="?page=account">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="name">Name:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="text" id="name" name="name"
                                    value="<?php echo $templateParams['userInfo'][0]['name']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['name']; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="surname">Surname:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="text" id="surname" name="surname"
                                    value="<?php echo $templateParams['userInfo'][0]['surname']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['surname']; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="username">Username:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="text" id="username" name="username"
                                    value="<?php echo $templateParams['userInfo'][0]['username']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['username']; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="email">E-mail:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="text" id="email" name="email"
                                    value="<?php echo $templateParams['userInfo'][0]['email']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['email']; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="birthday">Birthday:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="date" id="birthday" name="birthday"
                                    value="<?php echo $templateParams['userInfo'][0]['birthday']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['birthday']; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Card 6 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="card_number">Card number:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="text" id="card_number" name="card_number"
                                    value="<?php echo $templateParams['userInfo'][0]['card_number']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['card_number']; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <!-- Card 7 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="password">Password:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="password" id="password" name="password"
                                    value="<?php echo $templateParams['userInfo'][0]['password']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['password']; ?>"
                                    disabled />
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <img src="<?php echo UPLOAD_DIR; ?>closed-eye.svg" alt="Hide password" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 8 -->
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card bg-purple-gray">
                            <label class="card-header form-label" for="confirmPassword">Confirm password:</label>
                            <div class="input-group card-body">
                                <input class="form-control" type="password" id="confirmPassword" name="confirmPassword"
                                    value="<?php echo $templateParams['userInfo'][0]['password']; ?>"
                                    data-original-value="<?php echo $templateParams['userInfo'][0]['password']; ?>" />
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <img src="<?php echo UPLOAD_DIR; ?>closed-eye.svg" alt="Show password" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-primary bg-light-purple border-0 text-purple">Edit</button>
                    <button type="submit" class="btn btn-success" style="display: none;">Save</button>
                    <button type="button" class="btn btn-danger" style="display: none;">Cancel</button>
                </div>
            </form>
        </section>
    </div>
</div>