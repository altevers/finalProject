UPDATE membership
SET active = "N"
WHERE userID = :userID
AND chapterID = :chapterID;