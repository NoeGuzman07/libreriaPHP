<!-- Modulo / Login -->
<div class="login d-flex align-items-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="formulario">
                    <img src="<?php echo $url; ?>views/assets/css/img/logo/logo.png" class="logo" alt="">
                    <!-- Form -->
                    <form id="formularioIngreso" onsubmit="return false;">

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Usuario</span>
                                </div>
                                <input class="form-control" id="correoElectronicoIngreso" name="" placeholder="Correo Electronico" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Contraseña</span>
                                </div>
                                <input class="form-control" id="contrasenaIngreso" name="" placeholder="Contraseña" type="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="btn" type="submit" value="Ingresar">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>