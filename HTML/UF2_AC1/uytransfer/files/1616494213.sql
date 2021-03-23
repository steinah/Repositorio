CREATE or ALTER PROCEDURE AGREGAR_AL_CARRITO ( @p_comanda CHAR(10), @p_codiBarres CHAR(12), @p_unitats INT)
AS
BEGIN
	DECLARE @cantidad INT 
	DECLARE @descuento DECIMAL(4,2)
	DECLARE @unitatsActuals INT

	SET @cantidad = (
	SELECT COUNT(@p_comanda)
	FROM detalle_pedidos
	WHERE videojuego = @p_codiBarres and detalle_pedidos.pedido = @p_comanda)


IF	@cantidad != 0
    BEGIN
        PRINT 'Exists'
		UPDATE detalle_pedidos
		SET unidades = unidades + @p_unitats
		WHERE videojuego = @p_codiBarres and detalle_pedidos.pedido = @p_comanda
    END
ELSE
    BEGIN
        PRINT 'Doesn''t Exists'
		INSERT INTO detalle_pedidos (pedido, videojuego, unidades, descuento)
		VALUES (@p_comanda, @p_codiBarres, @p_unitats, 0.00)
    END

	SET @unitatsActuals = (select SUM(detalle_pedidos.unidades)
							from detalle_pedidos
							where videojuego = @p_codiBarres)
	SET @descuento = case @unitatsActuals
						WHEN 2 THEN 0.1
						WHEN 3 THEN 0.2
						WHEN 4 THEN 0.3
						WHEN 5 THEN 0.4
						WHEN 6 THEN 0.5
						WHEN 7 THEN 0.6
						WHEN 8 THEN 0.7
						WHEN 9 THEN 0.8
						WHEN 10 THEN 0.9
						ELSE 0.9
						END
	UPDATE detalle_pedidos
	SET descuento = @descuento

END
GO