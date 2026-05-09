CREATE DATABASE IF NOT EXISTS real_estate CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE real_estate;

CREATE TABLE users (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  phone VARCHAR(30),
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('buyer','renter','agent','seller','admin') NOT NULL DEFAULT 'buyer',
  language VARCHAR(10) DEFAULT 'en',
  currency VARCHAR(10) DEFAULT 'USD',
  status ENUM('active','inactive','banned') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE profiles (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL,
  avatar_url VARCHAR(255),
  bio TEXT,
  preferences_json JSON,
  verified TINYINT(1) DEFAULT 0,
  social_links_json JSON,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE properties (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  owner_id BIGINT,
  agent_id BIGINT,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  description TEXT,
  property_type VARCHAR(50),
  listing_type ENUM('sale','rent','short_stay') NOT NULL,
  status ENUM('draft','review','live','rejected','sold','rented') DEFAULT 'draft',
  price DECIMAL(14,2) NOT NULL,
  currency VARCHAR(10) DEFAULT 'USD',
  bedrooms INT DEFAULT 0,
  bathrooms INT DEFAULT 0,
  area_sqft INT DEFAULT 0,
  year_built INT DEFAULT NULL,
  country VARCHAR(80),
  city VARCHAR(80),
  neighborhood VARCHAR(120),
  address VARCHAR(255),
  latitude DECIMAL(10,7),
  longitude DECIMAL(10,7),
  featured TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE property_media (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  property_id BIGINT NOT NULL,
  media_type ENUM('image','video') NOT NULL,
  url VARCHAR(255) NOT NULL,
  thumbnail_url VARCHAR(255),
  sort_order INT DEFAULT 0,
  alt_text VARCHAR(255),
  FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_amenities (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  property_id BIGINT NOT NULL,
  amenity_name VARCHAR(120) NOT NULL,
  FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_favorites (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL,
  property_id BIGINT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uniq_fav (user_id, property_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE conversations (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  property_id BIGINT NOT NULL,
  buyer_id BIGINT NOT NULL,
  agent_id BIGINT NOT NULL,
  last_message_at TIMESTAMP NULL,
  status ENUM('open','closed') DEFAULT 'open',
  FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE messages (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  conversation_id BIGINT NOT NULL,
  sender_id BIGINT NOT NULL,
  body TEXT NOT NULL,
  attachment_url VARCHAR(255),
  read_at TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE
);

CREATE TABLE bookings (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL,
  property_id BIGINT NOT NULL,
  agent_id BIGINT,
  booking_type ENUM('visit','virtual','callback') NOT NULL DEFAULT 'visit',
  scheduled_at DATETIME NOT NULL,
  status ENUM('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  notes TEXT,
  price_snapshot DECIMAL(14,2),
  currency VARCHAR(10) DEFAULT 'USD',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reviews (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL,
  property_id BIGINT NOT NULL,
  rating DECIMAL(2,1) NOT NULL,
  title VARCHAR(200),
  body TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transactions (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  booking_id BIGINT NOT NULL,
  payer_id BIGINT NOT NULL,
  amount DECIMAL(14,2) NOT NULL,
  currency VARCHAR(10) DEFAULT 'USD',
  provider VARCHAR(50),
  status ENUM('pending','paid','failed','refunded') DEFAULT 'pending',
  payment_reference VARCHAR(120),
  refund_status ENUM('none','requested','completed') DEFAULT 'none',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE leads (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  property_id BIGINT NOT NULL,
  agent_id BIGINT NOT NULL,
  user_id BIGINT NOT NULL,
  source VARCHAR(80),
  status VARCHAR(40) DEFAULT 'new',
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE audit_logs (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  actor_user_id BIGINT NOT NULL,
  action VARCHAR(120) NOT NULL,
  entity_type VARCHAR(80),
  entity_id BIGINT,
  metadata_json JSON,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE search_queries (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT,
  query_text VARCHAR(255),
  filters_json JSON,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE saved_searches (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL,
  name VARCHAR(120) NOT NULL,
  query_json JSON,
  alerts_enabled TINYINT(1) DEFAULT 1
);

CREATE TABLE recommendation_events (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL,
  property_id BIGINT NOT NULL,
  event_type VARCHAR(50),
  score DECIMAL(5,2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE languages (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  code VARCHAR(10) NOT NULL,
  name VARCHAR(60) NOT NULL
);

CREATE TABLE translations (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  entity_type VARCHAR(80),
  entity_id BIGINT,
  field_key VARCHAR(80),
  language_code VARCHAR(10),
  translated_text TEXT
);
