CREATE DATABASE IF NOT EXISTS tienda_padel;
USE tienda_padel;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100), email VARCHAR(100) UNIQUE, password VARCHAR(255),
    role ENUM('user', 'admin') DEFAULT 'user', security_question VARCHAR(255), security_answer VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200), brand VARCHAR(50), description TEXT, short_description VARCHAR(255),
    price DECIMAL(10,2), image VARCHAR(500), stock INT, category VARCHAR(50)
);

INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@padelpro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

TRUNCATE TABLE products;

-- IMÁGENES QUE FUNCIONAN SIEMPRE (Placehold.co genera la imagen al vuelo con texto)
INSERT INTO products (name, brand, category, price, stock, image, short_description, description) VALUES
('Bullpadel Vertex 03', 'Bullpadel', 'Palas', 249.95, 20, 'https://placehold.co/400x400/232f3e/FFF?text=Bullpadel+Vertex', 'Potencia máxima', 'La pala definitiva de potencia.'),
('Nox AT10 Genius 18K', 'Nox', 'Palas', 285.00, 15, 'https://placehold.co/400x400/232f3e/FFF?text=Nox+AT10', 'La joya de Tapia', 'Carbono 18K para un tacto único.'),
('Adidas Metalbone 3.2', 'Adidas', 'Palas', 270.90, 10, 'https://placehold.co/400x400/232f3e/FFF?text=Adidas+Metalbone', 'Potencia personalizable', 'Weight & Balance System incluido.'),
('Head Speed Pro X', 'Head', 'Palas', 239.95, 12, 'https://placehold.co/400x400/232f3e/FFF?text=Head+Speed', 'Velocidad Auxetic', 'Sensación de impacto mejorada.'),
('Siux Diablo Revolution', 'Siux', 'Palas', 299.00, 8, 'https://placehold.co/400x400/232f3e/FFF?text=Siux+Diablo', 'El mito renovado', 'Carbono 12K y grafeno.'),
('Asics Gel-Resolution 9', 'Asics', 'Zapatillas', 119.00, 50, 'https://placehold.co/400x400/ff6600/FFF?text=Asics+Gel+9', 'Estabilidad superior', 'Tecnología DYNAWALL.'),
('Bullpadel Hack Vibram', 'Bullpadel', 'Zapatillas', 95.50, 40, 'https://placehold.co/400x400/ff6600/FFF?text=Bullpadel+Hack', 'Suela Vibram', 'Durabilidad extrema.'),
('Camiseta Bullpadel WPT', 'Bullpadel', 'Ropa', 39.95, 100, 'https://placehold.co/400x400/555/FFF?text=Camiseta+WPT', 'Oficial WPT', 'Tejido técnico.'),
('Paletero Adidas Multi', 'Adidas', 'Paleteros', 64.95, 30, 'https://placehold.co/400x400/777/FFF?text=Paletero+Adidas', 'Gran capacidad', 'Bolsillo térmico.'),
('Bote Head Padel Pro S', 'Head', 'Pelotas', 5.95, 500, 'https://placehold.co/400x400/EEE/000?text=Bote+Head', 'Velocidad', 'Pelota oficial WPT.');
