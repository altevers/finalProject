SELECT c.content
FROM comments c
INNER JOIN users u ON c.postedAbout = u.userID
WHERE chapterID = :chapterID
AND postedAbout = :postedAbout
ORDER BY u.lastName, u.firstName;