# 🚀 Code Review Project

This is simple PHP project for testing IA code review tools. The project use **Docker** and **Composer**, but you don't need to install composer localy.

## 🛠️ Setup the project

1. **Clone** the repo:

   ```sh
   git clone https://github.com/your-repo/code-review-project.git
   cd code-review-project
   ```

2. **Build and run** with Docker:

   ```sh
   docker-compose build --no-cache
   docker-compose up -d
   ```

3. **Check if it works**

   ```sh
   curl -X GET http://localhost:8001
   ```

   If you see a response, congrats! If not... uhh, try again? 😅

## 🛠️ Developing

- All PHP files is inside `src/`
- Public files is in `public/`
- We use `composer dump-autoload`, because PHP likes order!

## 🐛 Troubleshoot

If nothing work:

- Did you try turn off and on again? (`docker-compose restart`)
- Maybe you forgot the `--no-cache`? Run `docker-compose build --no-cache`
- Is your cat on your keyboard? Move the cat.

## 🎉 Contributing

Fork it, fix it, break it (not too much) and send PR. We like help! 🙌

## 📜 License

IDK yet, just don’t steal and we’re good. 😎

*this readme and project were created with the help of ChatGPT*
