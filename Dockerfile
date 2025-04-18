FROM php:8.1-cli

# Copy project files
COPY . /app
WORKDIR /app

# Expose port
EXPOSE 3000

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:3000"]
