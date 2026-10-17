
CREATE TABLE users (id SERIAL PRIMARY KEY, email TEXT UNIQUE NOT NULL, password_hash TEXT NOT NULL, name TEXT, phone TEXT, created_at TIMESTAMP DEFAULT NOW());
CREATE TABLE treks (id SERIAL PRIMARY KEY, title TEXT NOT NULL, region TEXT, difficulty TEXT, duration_days INT, max_altitude INT, price DECIMAL(10,2), description TEXT, image TEXT, created_at TIMESTAMP DEFAULT NOW());
CREATE TABLE guides (id SERIAL PRIMARY KEY, name TEXT NOT NULL, experience_years INT, certifications TEXT, phone TEXT, created_at TIMESTAMP DEFAULT NOW());
CREATE TABLE bookings (id SERIAL PRIMARY KEY, user_id INT REFERENCES users(id), trek_id INT REFERENCES treks(id), guide_id INT REFERENCES guides(id), group_size INT, start_date DATE, status TEXT DEFAULT 'pending', total_price DECIMAL(15,2), created_at TIMESTAMP DEFAULT NOW());
CREATE TABLE reviews (id SERIAL PRIMARY KEY, booking_id INT REFERENCES bookings(id), rating INT CHECK (rating BETWEEN 1 AND 5), comment TEXT, created_at TIMESTAMP DEFAULT NOW());
CREATE INDEX idx_treks_region ON treks(region);
CREATE INDEX idx_bookings_user ON bookings(user_id);
