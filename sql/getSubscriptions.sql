SELECT chapterID
FROM membership
WHERE userID = :userID
AND active = "Y"
AND responsibilityID = 3;