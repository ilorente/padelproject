CREATE DATABASE IF NOT EXISTS tienda_padel;
USE tienda_padel;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    brand VARCHAR(50),
    description TEXT,
    short_description VARCHAR(255),
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(500) NOT NULL,
    stock INT DEFAULT 0,
    category VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'paid',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(200) NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Admin (password: password)
INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@padelpro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Productos demo
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
