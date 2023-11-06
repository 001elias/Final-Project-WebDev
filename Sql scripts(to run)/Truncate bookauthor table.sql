-- First, create a temporary table to store the book IDs you want to keep
CREATE TEMPORARY TABLE books_to_keep (bookId INT);

-- Insert the book IDs from selected_books into books_to_keep
INSERT INTO books_to_keep (bookId)
SELECT bookId FROM selected_books;

-- Delete records from the book_author table that are not associated with the selected books
DELETE FROM book_author
WHERE bookId NOT IN (SELECT bookId FROM books_to_keep);

-- Drop the temporary table
DROP TEMPORARY TABLE books_to_keep;


-- You can now delete the selected_books table