-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: libreria
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autores` (
  `id_autor` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `autor` varchar(255) NOT NULL COMMENT 'Nombre y apellido del autor',
  PRIMARY KEY (`id_autor`),
  UNIQUE KEY `nombre_autor_UNIQUE` (`autor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla de autores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,'Antoine de Saint-Exupéry'),(3,'Howard Phillips Lovecraft'),(2,'J. K. Rowling'),(5,'José Hernández'),(4,'Robert Louis Stevenson');
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autores_libros`
--

DROP TABLE IF EXISTS `autores_libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autores_libros` (
  `id_libro` int(10) unsigned NOT NULL,
  `id_autor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_libro`,`id_autor`),
  KEY `al_id_autor_fk_idx` (`id_autor`),
  CONSTRAINT `al_id_autor_fk` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `al_id_libro_fk` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores_libros`
--

LOCK TABLES `autores_libros` WRITE;
/*!40000 ALTER TABLE `autores_libros` DISABLE KEYS */;
INSERT INTO `autores_libros` VALUES (1,1),(4,2),(5,2),(7,4),(8,3),(9,5);
/*!40000 ALTER TABLE `autores_libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos` (
  `id_genero` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `genero` varchar(45) NOT NULL,
  PRIMARY KEY (`id_genero`),
  UNIQUE KEY `genero_UNIQUE` (`genero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que contiene la clasificacion/etiqueta/categoria, por la cual se van a clasificar los libros.\nEjemplo infantil, terror, aventura, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (2,'fantasia'),(1,'infantil'),(4,'poesía'),(3,'terror');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos_libros`
--

DROP TABLE IF EXISTS `generos_libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos_libros` (
  `id_libro` int(11) unsigned NOT NULL,
  `id_genero` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_libro`,`id_genero`),
  KEY `ads_idx` (`id_genero`),
  CONSTRAINT `gl_id_genero_fk` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gl_id_libro_fk` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos_libros`
--

LOCK TABLES `generos_libros` WRITE;
/*!40000 ALTER TABLE `generos_libros` DISABLE KEYS */;
INSERT INTO `generos_libros` VALUES (1,1),(1,2),(4,2),(5,2),(7,3),(8,3),(9,4);
/*!40000 ALTER TABLE `generos_libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libros`
--

DROP TABLE IF EXISTS `libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libros` (
  `id_libro` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_libro`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla con informacion de los libros';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libros`
--

LOCK TABLES `libros` WRITE;
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
INSERT INTO `libros` VALUES (1,'El Principito','La historia se centra en un pequeño príncipe que realiza una travesía por el universo. En este viaje descubre la extraña forma en que los adultos ven la vida y comprende el valor del amor y la amistad.'),(4,'Harry Potter y la piedra filosofal','Harry Potter se ha quedado huérfano y vive en casa de sus abominables tíos y del insoportable primo Dudley. Harry se siente muy triste y solo, hasta que un buen día recibe una carta que cambiará su vida para siempre. En ella le comunican que ha sido aceptado como alumno en el colegio interno Hogwarts de magia y hechicería.\nA partir de ese momento, la suerte de Harry da un vuelco espectacular. En esa escuela tan especial aprenderá encantamientos, trucos fabulosos y tácticas de defensa contra las malas artes. Se convertirá en el campeón escolar de quidditch, especie de fútbol aéreo que se juega montado sobre escobas, y se hará un puñado de buenos amigos... aunque también algunos temibles enemigos. Pero sobre todo, conocerá los secretos que le permitirán cumplir con su destino. Pues, aunque no lo parezca a primera vista, Harry no es un chico común y corriente. ¡Es un verdadero mago!'),(5,'Harry Potter y la cámara secreta','Mientras Harry espera impaciente en casa de sus insoportables tíos el inicio del segundo curso del Colegio Hogwarts de Magia y Hechicería, un elfo aparece en su habitación y le advierte de que una amenaza mortal se cierne sobre la escuela.\nHarry no se lo piensa dos veces y, acompañado de Ron, se dirige a Hogwarts en un coche volador. Pero, ¿puede un aprendiz de mago defender la escuela de los malvados que pretenden destruirla?\nSin saber que alguien ha abierto la Cámara de los Secretos, dejando escapar una serie de monstruos peligrosos, Harry y sus amigos Ron y Hermione tendrán que enfrentarse con arañas gigantes, serpientes encantadas, fantasmas enfurecidos y, sobre todo, con la mismísima reencarnación de su más temible adversario'),(7,'El extraño caso del doctor Jekyll y el señor Hyde','Londres, a fines del siglo XIX, es un modelo de ciudad moderna: suntuosos edificios, calles iluminadas por faroles de gas, elegantes carruajes y peatones refinados… Sin embargo, en medio de tanto esplendor, empiezan a surgir los indicios de una amenaza, a través de los crímenes de un tal señor Hyde. A lo largo de un relato que mantiene en vilo al lector, Stevenson va desvelando poco a poco las claves de ese siniestro personaje, hasta llegar al mayor de todos los misterios: su extraña relación con el doctor Jekyll, un ciudadano ejemplar… Desde el momento de su publicación, esta novela se ha consagrado como una obra maestra del suspenso y como una fascinante indagación sobre el alma humana.'),(8,'La Llamada de Cthulhu','En el invierno de 1926 fallece el tío abuelo del narrador de este cuento de culto, profesor de lenguas semíticas en la universidad de Brown y autoridad en el campo de las inscripciones antiguas. La medicina no puede aclarar las circunstancias de esta muerte envuelta por el misterio. El narrador, heredero de su legado, se vuelca en la interpretación arqueológica de un bajorrelieve que va acompañado de un texto en una lengua desconocida que hace referencia a un culto secreto del que parece ser un dios olvidado y extraterrestre con el nombre de «Cthulhu».'),(9,'El gaucho Martin Fierro','Martín Fierro es un gaucho trabajador al que la injusticia social lo vuelve gaucho matrero (fuera de la ley).Narra el carácter independiente, heroico y sacrificado del gaucho. El poema es, en parte, una protesta en contra de la política del presidente argentino Domingo Faustino Sarmiento de reclutar forzosamente a los gauchos para ir a la frontera contra los indígenas.');
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_usuarios_libros`
--

DROP TABLE IF EXISTS `lista_usuarios_libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_usuarios_libros` (
  `id_usuario` int(10) unsigned NOT NULL,
  `id_libro` int(10) unsigned NOT NULL,
  `leido` date DEFAULT NULL,
  PRIMARY KEY (`id_usuario`,`id_libro`),
  KEY `lul_id_libro_idx` (`id_libro`),
  CONSTRAINT `lul_id_libro` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lul_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_usuarios_libros`
--

LOCK TABLES `lista_usuarios_libros` WRITE;
/*!40000 ALTER TABLE `lista_usuarios_libros` DISABLE KEYS */;
INSERT INTO `lista_usuarios_libros` VALUES (1,1,NULL);
/*!40000 ALTER TABLE `lista_usuarios_libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `clave` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla con informacion de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'mevanaborrar','prueba','prueba','estonoestaencriptado');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-29  6:54:46
