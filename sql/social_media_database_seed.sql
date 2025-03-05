-- Sample data for Users Table
INSERT INTO users (username, email, password, bio, profile_pic)
VALUES
('john_doe', 'johndoe@example.com', 'hashed_password1', 'Just a regular guy', '/images/john.jpg'),
('jane_doe', 'janedoe@example.com', 'hashed_password2', 'Lover of life and coffee', '/images/jane.jpg'),
('alice_smith', 'alice@example.com', 'hashed_password3', 'Travel enthusiast', '/images/alice.jpg'),
('bob_brown', 'bob@example.com', 'hashed_password4', 'Tech geek and gamer', '/images/bob.jpg');

-- Sample data for Tweets Table
INSERT INTO tweets (user_id, content, likes_count, retweets_count)
VALUES
(1, 'This is my first tweet!', 5, 2),
(2, 'Good morning everyone! #blessed', 10, 5),
(3, 'Exploring the beauty of nature today. #travel', 3, 1),
(4, 'Loving the new tech gadgets! #geeklife', 2, 0);

-- Sample data for Follows Table
INSERT INTO follows (follower_id, following_id)
VALUES
(1, 2), -- John follows Jane
(1, 3), -- John follows Alice
(2, 1), -- Jane follows John
(3, 4), -- Alice follows Bob
(4, 1); -- Bob follows John

-- Sample data for Likes Table
INSERT INTO likes (user_id, tweet_id)
VALUES
(1, 2),  -- John likes Jane's tweet
(2, 1),  -- Jane likes John's tweet
(3, 4),  -- Alice likes Bob's tweet
(4, 3);  -- Bob likes Alice's tweet

-- Sample data for Comments Table
INSERT INTO comments (tweet_id, user_id, content)
VALUES
(1, 2, 'Nice first tweet!'),             -- Jane comments on John's tweet
(2, 1, 'Good morning, Jane!'),           -- John comments on Jane's tweet
(3, 4, 'Looks amazing. Where is this?'), -- Bob comments on Alice's tweet
(4, 3, 'Totally agree! Tech is awesome');-- Alice comments on Bob's tweet