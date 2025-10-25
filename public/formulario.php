<div class="bg-light p-5 rounded">
    <div class="col-sm-8 mx-auto">
        <form action="checkout.php" method="post">            
            <input type="text" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres Completos</label>
                <input type="text" class="form-control" id="nombres" name="nombres">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Email address</label>
                <input type="email" class="form-control" id="correo" name="correo">
            </div>
            <button type="submit" class="btn btn-primary">Ir a Pagar</button>
        </form>
    </div>
</div>