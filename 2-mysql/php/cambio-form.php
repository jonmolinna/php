<div>
    <label for="email">Email: </label>
    <input 
        type="email" 
        id="email" 
        class="cambio" 
        name="email_txt" 
        placeholder="Escribe tu nombre" 
        title="Tu email" 
        required 
        value="<?php echo $registro_contacto["email"]; ?>"
        disabled
    />
    <input 
        type="hidden"
        name="email_hdn"
        value="<?php echo $registro_contacto["email"]; ?>"
    >
</div>
<div>
    <label for="nombre">Nombre: </label>
    <input 
        type="text" 
        id="nombre"
        class="cambio"
        name="nombre_txt" 
        placeholder="Escribe tu nombre" 
        title="Tu nombre" 
        required
        value="<?php echo $registro_contacto['nombre']; ?>"
    >
</div>
<div>
    <label for="m">Sexo: </label>
    <input 
        type="radio"
        id="m" 
        name="sexo_rdo" 
        title="Tu sexo" 
        value="M" 
        required
        <?php if($registro_contacto["sexo"]=="M"){ echo "checked"; } ?>
    >
    &nbsp;<label for="m">Masculino</label>
    &nbsp;&nbsp;&nbsp;
    <input 
        type="radio"
        id="f" 
        name="sexo_rdo" 
        title="Tu sexo"
        value="F" 
        required
        <?php if($registro_contacto["sexo"] == 'F'){ echo "checked"; } ?>
    >
    &nbsp;<label for="f">Femenino</label>
</div>
<div>
    <label for="nacimiento">Fecha de nacimiento: </label>
    <input 
        type="date"
        id="nacimiento"
        class="cambio"
        name="nacimiento_txt" 
        title="Tu cumple" 
        required
        value="<?php echo $registro_contacto["nacimiento"]; ?>"
    >
</div>
<div>
    <label for="telefono">Telefono: </label>
    <input 
        type="number" 
        id="telefono" 
        class="cambio" 
        name="telefono_txt" 
        placeholder="Escribe tu telefono" 
        title="Tu telefono" 
        required
        value="<?php echo $registro_contacto["telefono"] ?>"
    >
</div>
<div>
    <label for="pais">Pais: </label>
    <select id="pais" class="cambio" name="pais_slc" required>
        <option value="">- - -</option>
        <?php include("select-pais.php"); ?>
    </select>
</div>
<div>
    <label for="foto">Foto: </label>
    <div class="adjuntar-archivo cambio">
        <input type="file" id="foto" name="foto_fls" title="Sube tu foto">
        <input type="hidden" name="foto_hdn" value="<?php echo $registro_contacto["imagen"]; ?>">
    </div>
    <div>
        <img src="<?php echo "img/fotos/".$registro_contacto["imagen"]; ?>" alt="">
    </div>
</div>
<div>
    <input type="submit" id="enviar-alta" class="cambio" name="enviar_btn" value="Agregar">
</div>