-- SQLite schema used by the booking system
-- The app auto-creates this table on first run.

CREATE TABLE IF NOT EXISTS bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    booking_ref TEXT NOT NULL UNIQUE,
    booking_type TEXT NOT NULL DEFAULT 'package',
    package_id TEXT,
    package_name TEXT NOT NULL,
    country TEXT,
    departure_from TEXT,
    destination TEXT,
    travel_date TEXT,
    travel_time TEXT,
    leave_date TEXT,
    leave_time TEXT,
    guests INTEGER NOT NULL DEFAULT 1,
    customer_name TEXT NOT NULL,
    customer_email TEXT NOT NULL,
    customer_phone TEXT NOT NULL,
    payment_method TEXT NOT NULL DEFAULT 'cash',
    payment_reference TEXT,
    payment_status TEXT NOT NULL DEFAULT 'pending',
    booking_status TEXT NOT NULL DEFAULT 'pending',
    amount REAL NOT NULL DEFAULT 0,
    currency TEXT NOT NULL DEFAULT 'USD',
    message TEXT,
    booked_by TEXT,
    booked_role TEXT,
    booking_channel TEXT NOT NULL DEFAULT 'website',
    ip_address TEXT,
    user_agent TEXT,
    created_at TEXT NOT NULL,
    updated_at TEXT NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_bookings_created_at ON bookings(created_at);
CREATE INDEX IF NOT EXISTS idx_bookings_status ON bookings(booking_status);
CREATE INDEX IF NOT EXISTS idx_bookings_payment ON bookings(payment_status);
