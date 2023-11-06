CREATE TEMPORARY TABLE selected_books (bookId INT);

INSERT INTO selected_books (bookId)
SELECT MIN(bookId) AS minBookId
FROM book
GROUP BY catId
LIMIT 23; -- Assuming you have 23 categories

INSERT INTO selected_books (bookId)
SELECT bookId
FROM book
WHERE bookId NOT IN (SELECT bookId FROM selected_books)
ORDER BY RAND()
LIMIT 27; -- (50 - 23) Additional random books


SELECT b.*, a.*
FROM book AS b
JOIN selected_books AS sb ON b.bookId = sb.bookId
JOIN book_author AS ba ON b.bookId = ba.bookId
JOIN author AS a ON ba.authorId = a.authorId;

