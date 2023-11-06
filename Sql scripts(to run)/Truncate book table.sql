-- First, create a table to store the book IDs you want to keep
CREATE TEMPORARY TABLE books_to_keep (bookId INT);

-- Insert the book IDs from selected_books into books_to_keep
INSERT INTO books_to_keep (bookId)
SELECT bookId FROM selected_books;

-- Delete all books from the book table that are not in books_to_keep
DELETE FROM book
WHERE bookId NOT IN (SELECT bookId FROM books_to_keep);

-- Drop the temporary table
DROP TEMPORARY TABLE books_to_keep;
