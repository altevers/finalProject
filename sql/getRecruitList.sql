SELECT DISTINCT u.firstName, u.lastName, m.userID
FROM users u
INNER JOIN membership m ON u.userID = m.userID
WHERE chapterID = :chapterID
AND responsibilityID = 3
ORDER BY u.lastName, u.firstName;