## Student case


I used  slim php framework so I can have some base setup for containers and routing.

---
In order to run the app, clone the repo, `cd public` and `php -S localhost:8888`

---

I have to mention that I didnt quite understand the "CSMB" way of how it determinated if student pass or not.

I mean on this part `"CSMB discards the lowest grade, if you have more than 2 grades, and considers pass if
                     his biggest grade is bigger than 8"`
                     
So I made it my way 😅

---
I didnt implement any databases, but instead used the repository pattern and implement Memory repository.

You can check `public/index.php` for how the repository is implemented.

I took me 5-6 hours. I am sorry I delayed this a bit, but I was quite busy latly.