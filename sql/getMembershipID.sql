SELECT membershipID
FROM membership
WHERE userID = :userID
AND chapterID = :chapterID
AND responsibilityID = 3;