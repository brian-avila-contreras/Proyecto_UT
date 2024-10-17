
CREATE TABLE `tipos_usuario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tipos_usuario` (`id`, `tipo`) VALUES
(1, 'admin'),
(2, 'empleado');
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario_id` int(11) DEFAULT NULL,
  `actividad` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `usuarios` (`id`, `nombre_usuario`, `email`, `password`, `tipo_usuario_id`, `actividad`) VALUES
(2, 'brian', 'bjulian1605@gmail.com', '$2y$10$PqvpGV3KxHBoZmgLmWb.MOGfYD6RsQrzs7soP/X.bOHIs/xmNCN3u', 2, 1);
ALTER TABLE `tipos_usuario`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `tipo_usuario_id` (`tipo_usuario_id`);
ALTER TABLE `tipos_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuario` (`id`) ON DELETE SET NULL;


