<div class="bg-light rounded">
    <div class="col-sm-8 mx-auto">

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">¡Compra de Ebook's!</h4>
            <p>Por favor regalanos los siguientes datos para finalizar la compra.</p>
            <hr>
        </div>

        <form action="checkout.php" method="post">
            <input type="hidden" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres Completos</label>
                <input type="text" class="form-control" id="nombres" name="nombres">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de Celular</label>
                <input type="tel" class="form-control" id="telefono" name="telefono">
            </div>
            <button type="submit" class="btn btn-primary">Ir a Pagar</button>
        </form>
    </div>
</div>