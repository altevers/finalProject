SELECT m.chapterID, c.chapterName
FROM membership m
INNER JOIN chapter c ON m.chapterID = c.chapterID
WHERE userID = :userID
AND responsibilityID = 1 OR responsibilityID = 2;