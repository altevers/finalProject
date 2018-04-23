UPDATE users
SET password = :password, email = :email, gpa = :gpa, classLevel = :classLevel, highSchool = :highSchool, cellPhone = :cellPhone
WHERE userID = :userID;