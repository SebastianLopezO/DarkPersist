# SitePersist

💻 Desarrolladores

| [<img src="https://avatars.githubusercontent.com/u/100486485?=4" width="100px;"/><br /><sub><b>Sebastian L.</b></sub>](https://github.com/SebastianLopezOsorno-SENA) | [<img src="https://avatars.githubusercontent.com/u/103140681?v=4" width="100px;"/><br /><sub><b>Mateo L.</b></sub>](https://github.com/Matthew1403) |
| :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------: | :----------------------------------------------------------------------------------------------------------------------------------------------------------: |

## ¿Que es?

SitePersist es un sistema de gestión de solicitudes para la reserva de espacios y equipos tecnológicos enfocada a la Institución Universitaria Salazar y Herrera, a través de un aplicativo web para cualquier tipo de dispositivos, permitiendo de esta manera la optimización de procesos de reservas de la Universidad.

## Eslogan  y Logo

<img src="http://adminsitepersist.herokuapp.com/resources/assets/img/logo--black.png">

> “Conectando espacios y experiencias”

## Planteamiento del Problema

El sistema de gestión para la Reserva de espacios de la IUSH, posee una limitación de uso y viabilidad para la comunidad académica y personal externo.

## Objetivo General

Implementar un sistema de gestión de solicitudes para reserva de los espacios y equipos tecnológicos de la IUSH, a través de un aplicativo web para cualquier tipo de dispositivos, permitiendo la optimización de procesos de reservas de la Universidad.

## Objetivos específicos

- Establecer una plataforma web para las reservas, accediendo a la información desde cualquier dispositivo.
- Generar estadísticas del uso de los diferentes espacios y equipos tecnológicos, a través de un dashboard dinámico e intuitivo, determinando la usabilidad media en un año.
- Implementar un sistema de inventario, automatizando la gestión de los equipos electrónicos.

## Alcance

SitePersist puede ser ampliamente desarrollada. 
Por ahora, la plataforma será adaptable a diferentes modelos de dispositivos y tendrá disponible el acceso tanto de usuarios como de administrador, contando con algunas funciones disponibles como galería e inventario de los diferentes espacios y equipos tecnológicos.

## Estado del Arte

En la actualidad existen diferentes sistemas de reservaciones con un mayor enfoque en el área turística, sistemas como smoobu y SiteMinder. También hay sistemas de reserva de áreas de trabajo como e-desk y tenea-talent, sistemas generales que no cumplen con la finalidad que se desea implementar en la IUSH.

## Propuesta
Aplicativo web con diseño responsive para todo tipo de dispositivos, con diferentes perfiles de usuario que permita hacer el registro de solicitudes con la finalidad de ser gestionado por un administrador, con registro de solicitudes que permita graficar el uso de los espacios y equipos tecnológicos de la IUSH.

# Especificaciones Tecnicas

## Tecnologias Implementadas

- apache (2.4.54)
- php (8.1.11)
- composer (2.2.18)
- nginx (1.22.0)


# 📑 Guía de Uso

A nivel de edición contenido hay que tener en cuenta una [Guía de Uso del Sitio Web](./docs/GUIA.md) ya que algunos contenidos tienen reglas especiales para poder ser agregados.

# Instrucciones
---

 1. Copiar el codigo de estructura de la base de datos y guardarlo con la Extension ***SQL***
 2. Iniciar los servicios de Apache y MySQL en XAMPP
 3. Ir a el localhost: http://localhost/phpmyadmin/
 4. Seleccionar **Nueva** en el panel lateral de ***phpMyAdmin***
 5. Colocar los siguientes Datos: 
--		       **Nombre de la base de Datos:** sitepersist
--		       **Cotejamiento:** utf8mb4_unicode_ci
 5. Le damos en **Crear**
 6. Abrimos la Base de Datos
 7. Le damo en Importar
 8. Seleccionar Archivo y Subes el archivo
 9. En la parte inferior dar click en continuar
 
 *Listo, ya puedes ejecutar localmente esta pagina web*

# Estructura de Base de Datos
## Especifiaciones base de datos

- phpMyAdmin SQL Dump
- version 4.7.1
- https://www.phpmyadmin.net/
- Servidor: brsebv2xscv11gd8urzz-mysql.services.clever-cloud.com
- Tiempo de generación: 10-11-2022 a las 02:11:21
- Versión del servidor: 8.0.15-5
- Versión de PHP: 7.0.33-0ubuntu0.16.04.16

- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
- SET AUTOCOMMIT = 0;
- START TRANSACTION;
- SET time_zone = "+00:00";

# Codigo SQL
---
~~~


--
-- Base de datos: `SitePersist`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `administrator` int(11) NOT NULL,
  `date_action` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `permission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios`
--

CREATE TABLE `espacios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `use_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `equipment` int(11) NOT NULL,
  `delivery_time` datetime NOT NULL,
  `return_time` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `amount_people` int(11) NOT NULL,
  `space` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad`
--

CREATE TABLE `seguridad` (
  `id` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `last_access` datetime NOT NULL,
  `last_change` datetime NOT NULL,
  `user` int(11) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` int(25) DEFAULT NULL,
  `img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'https://cdn-icons-png.flaticon.com/512/2154/2154462.png',
  `charge` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `administrator` (`administrator`);

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charge` (`charge`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `espacios`
--
ALTER TABLE `espacios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `equipment` (`equipment`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `space` (`space`),
  ADD KEY `event` (`event`);

--
-- Indices de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `espacios`
--
ALTER TABLE `espacios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD CONSTRAINT `acciones_ibfk_1` FOREIGN KEY (`administrator`) REFERENCES `administradores` (`id`);

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`charge`) REFERENCES `cargos` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`code`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`equipment`) REFERENCES `inventario` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`space`) REFERENCES `espacios` (`id`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`event`) REFERENCES `eventos` (`id`);

--
-- Filtros para la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD CONSTRAINT `seguridad_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuarios` (`id`);
COMMIT;
~~~

# Arquitectura e Infraestrcutura 

[Direct Link to Map](https://lucid.app/publicSegments/view/275ec419-eb6e-4f41-bf58-8ddff551e644/image.png)
![Mapa de Developing](/docs/developing.png)

## Developing

[Direct Link to Map](https://lucid.app/publicSegments/view/275ec419-eb6e-4f41-bf58-8ddff551e644/image.png)
![Mapa de Developing](/docs/local.png)

## Staging

[Direct Link to Map](https://lucid.app/publicSegments/view/275ec419-eb6e-4f41-bf58-8ddff551e644/image.png)
![Mapa de Developing](/docs/remote.png)

## Production

[Direct Link to Map](https://lucid.app/publicSegments/view/275ec419-eb6e-4f41-bf58-8ddff551e644/image.png)
![Mapa de Developing](/docs/developing.png)

# User Story Mapping

# SiteMap

# Page Outline

# DataBase Diagram

[Direct Link to Diagram](https://dbdiagram.io/embed/634f6f5a4709410195902535)
![Diagrama de Base de Datos](/docs/diagram.png)
