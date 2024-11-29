<!DOCTYPE html>
<html>
<head>
    <title>Parish of San Juan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url("../Images/mainBG.png");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        #aboutDiv {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .info2nd {
            font-size: 1rem;
            line-height: 1.5;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }
        p.copyright {
            text-align: center;
            font-size: 0.8rem;
            color: #666;
            margin-top: 30px;
        }
        .label {
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
    <script>
        // Check if user is logged in before setting appointment
        function setAppointment(sacrament) {
            const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

            if (isLoggedIn) {
                alert(`Redirecting to the appointment page for ${sacrament}.`);
                // Replace '#' with the actual URL of the appointment page for each sacrament
                window.location.href = `setAppointment.php?sacrament=${sacrament}`;
            } else {
                alert('You need to log in to set an appointment.');
                window.location.href = 'login.php'; // Redirect to login page
            }
        }
    </script>
</head>
<body>
    <?php include 'userHeader.php'; ?> 
    <div id="aboutDiv">
        <h1 style ="margin-top : 100px;">Seven Catholic Sacraments</h1>

        <!-- Baptism Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#baptism" aria-expanded="true">
                        BAPTISM
                    </button>
                </h2>
            </div>
            <div id="baptism" class="collapse show">
                <div class="card-body">
                    <img src="../Images/baptismLogo.jpg" class="img-fluid" alt="Baptism Logo">
                    <p class="info2nd">Baptism is the first sacrament that Catholics experience...</p>
                    <p class="info2nd">For those who convert later in life, it occurs during the process of conversion.</p>
                    <p class="info2nd">Baptism involves a priest performing a blessing over a person and anointing them with water. </p>
                    <p class="info2nd">While Baptism should be performed by a priest, technically anyone can perform a Baptism under extreme circumstances.</p>
                    <p class="info2nd">Baptism removes original sin from a person's soul as well as any other prior sins.</p>
                    <p class="info2nd"> Essentially, it is a ritual of rebirth that leaves a permanent mark on the soul.</p><br>
                    <p class="info2nd">Baptism is referenced several times in the Bible, most notably in John 3:5, in which Jesus says </p>
                    <p class="info2nd">''Very truly I tell you, no one can enter the kingdom of God unless they are born of water and the Spirit.''</p>
                    <button type="button" class="btn btn-secondary mt-4" onclick="baptism()">SET APPOINTMENT</button>
                </div>
            </div>
        </div>

        <!-- Eucharist Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#eucharist" aria-expanded="false">
                        EUCHARIST
                    </button>
                </h2>
            </div>
            <div id="eucharist" class="collapse">
                <div class="card-body">
                    <img src="../Images/father.jpg" class="img-fluid" alt="Eucharist Logo">
                    <p class="info2nd">The Eucharist is a sacrament that is performed...</p>
                    <p class="info2nd">In this sacrament, individuals consume bread and wine that, in Catholic doctrine,  </p>
                    <p class="info2nd"> are transubstantiated to become the blood and body of Christ during the rite.</p>
                    <p class="info2nd">The Eucharist is intended to connect Catholics with Christ and to recreate the Last Supper.  </p>
                    <p class="info2nd">The Eucharist is considered a reminder of and a continuation of Jesus's sacrifice for his followers and for humans in general. </p>
                    <p class="info2nd">The Eucharist is also called Communion. Only those who are baptized can take Communion.</p> <br>
                    <p class="info2nd"> The Eucharist is described in the Bible in John 6:54-56 as well as in other gospels: </p>
                    <p class="info2nd">''Whoever eats my flesh and drinks my blood has eternal life, and I will raise him on the last day.  </p>
                    <p class="info2nd">For my flesh is true food, and my blood is true drink. Whoever eats my flesh and drinks my blood remains in me and I in him.''</p>
                </div>
            </div>
        </div>

        <!-- Confirmation Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#confirmation" aria-expanded="false">
                        CONFIRMATION
                    </button>
                </h2>
            </div>
            <div id="confirmation" class="collapse">
                <div class="card-body">
                    <img src="../Images/confirmationLogo.jpg" class="img-fluid" alt="Confirmation Logo">
                    <p class="info2nd">Confirmation is the third sacrament of initiation and serves to "confirm" a baptized person in their faith.  </p>
                    <p class="info2nd">The rite of confirmation can occur as early as age 7 for children who were baptized as infants but is commonly received around age 13;</p>
                    <p class="info2nd">it is performed immediately after baptism for adult converts.</p>
                    <p class="info2nd"> A bishop or priest normally performs the rite, which includes the laying on of hands in prayer  </p>
                    <p class="info2nd">and blessing and the anointing of the forehead with chrism (holy oil) with the words,</p>
                    <p class="info2nd">”Be sealed with the gifts of the Holy Spirit.” In so "sealing" that person as a member of the church, </p>
                    <p class="info2nd"> the outward rite of confirmation signifies the inner presence of the Holy Spirit, </p><br>
                    <p class="info2nd">who is believed to provide the strength to live out a life of faith.  </p>
                    <p class="info2nd">At confirmation a Catholic may symbolically take the name of a saint to be his or her patron.</p>
              </div>
            </div>
        </div>

        <!-- Reconciliation Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#reconcile" aria-expanded="false">
                        RECONCILIATION
                    </button>
                </h2>
            </div>
            <div id="reconcile" class="collapse">
                <div class="card-body">
                    <img src="../Images/reconciliationLogo.jpg" class="img-fluid" alt="Reconciliation Logo">
                    <p class="info2nd">Also known as Confession or Penance, the sacrament of Reconciliation is seen</p>
                    <p class="info2nd"> as an opportunity for renewal and can be done as often as needed.  </p>
                    <p class="info2nd">Some Catholics participate weekly before receiving the Eucharist, </p>
                    <p class="info2nd">whereas others may seek the sacrament only during the penitential seasons of Lent or Advent.  </p>
                    <p class="info2nd">Reconciliation is a means of obtaining pardon from God for sins for which the sinner is truly remorseful, </p>
                    <p class="info2nd">and brings the sinner back into communion with God and the Church.</p>
                    <p class="info2nd"> The sacrament is an opportunity for self-reflection and requires that the person take full responsibility for his or her sins,</p>
                    <p class="info2nd">both those in thought and in action. During the rite, sins are recounted privately to a priest,  </p>
                    <p class="info2nd">who is seen as a healer aiding the process, and the priest commonly assigns acts of penance, such as specific prayers or acts of restitution, </p>
                    <p class="info2nd">to complete in the following days. A prayer of contrition is offered at the end of the confession, </p>
                    <p class="info2nd">and the newly absolved Catholic is urged to refrain from repeating those sins.  </p>
                </div>
            </div>
        </div>

        <!-- Annoint Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#annoint" aria-expanded="false">
                        ANNOINTING OF THE SICK
                    </button>
                </h2>
            </div>
            <div id="annoint" class="collapse">
                <div class="card-body">
                     <img src="../Images/annointingLogo.jpg" class="img-fluid" alt="Parish Logo" style="width: 800px; height: 600">
                    <p class="info2nd">Anointing of the Sick, formerly known as Extreme Unction, is a sacrament that is administered  </p>
                    <p class="info2nd">to give strength and comfort to the ill and to mystically unite their suffering with that of Christ during his Passion and death.  </p>
                    <p class="info2nd">This sacrament can be given to those who are afflicted with serious illness or injury, </p>
                    <p class="info2nd">those who are awaiting surgery, the weakened elderly, or to ill children who are old enough to understand its significance. </p>
                    <p class="info2nd">A person can receive the sacrament as many times as needed throughout their life,</p>
                    <p class="info2nd">and a person with a chronic illness might be anointed again if the disease worsens.</p>
                    <p class="info2nd"> The rite can be performed in a home or hospital by a priest, who prays over the person and anoints their head and hands with chrism (holy oil).</p>
                    <p class="info2nd">The priest may also administer the sacrament of the Eucharist if the person has been unable to receive it and can hear a confession if so desired.</p>
                    <p class="info2nd">If a person is at the point of death, the priest also administers a special Apostolic blessing in what is known as the Last Rites. </p>
              </div>
            </div>
        </div>

        <!-- Marriage Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#marriage" aria-expanded="false">
                        MARRIAGE
                    </button>
                </h2>
            </div>
            <div id="marriage" class="collapse">
                <div class="card-body">
                    <img src="../Images/marriageLogo.jpg" class="img-fluid" alt="Parish Logo" style="width: 800px; height: 600">
                    <p class="info2nd">In Catholicism marriage is a sacrament that a baptized man and a baptized woman  </p>
                    <p class="info2nd">administer to each other through their marriage vows and lifelong partnership. </p>
                    <p class="info2nd">Given that to a Catholic sacramental marriage</p>
                    <p class="info2nd">reflects the union of Christ with the church as his mystical body,</p>
                    <p class="info2nd">marriage is understood to be an indissoluble union. The rite commonly takes place during a mass, </p>
                    <p class="info2nd">with a priest serving as the minister of the mass and as a witness to the mutual consent of the couple.</p>
                    <p class="info2nd"> The marriage union is used to sanctify both the husband and wife by drawing them into a deeper understanding of God's love and is intended to be fruitful, </p>
                    <p class="info2nd">with any children to be raised within the teachings of the church.</p>
                    <button type="button" class="btn btn-secondary mt-4" onclick="wedding()">SET APPOINTMENT</button>
                </div>
            </div>
        </div>

        <!-- Order Section -->
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#order" aria-expanded="false">
                        HOLY ORDERS
                    </button>
                </h2>
            </div>
            <div id="order" class="collapse">
                <div class="card-body">
                   <img src="../Images/ordersLogo.jpg" class="img-fluid" alt="Parish Logo" style="width: 300px; height: auto;">                   
                    <p class="info2nd">Ordination, or Holy Orders, is a sacrament that is available only to men who are being ordained as deacons, priests, or bishops.   </p>
                    <p class="info2nd">As with Baptism and Confirmation, the sacrament is said to convey a special indelible “character” on the soul of the recipient.</p>
                    <p class="info2nd">During the rite, which typically occurs during a special Sunday mass, </p>
                    <p class="info2nd"> a prayer and blessing is offered as a bishop lays his hands on the head of the man being ordained.</p>
                    <p class="info2nd">In the case of the ordination of priests and bishops, this act confers the sacramental power to ordain (for bishops),</p>
                    <p class="info2nd">baptize, confirm, witness marriages, absolve sins, and consecrate the Eucharist.</p>
                    <p class="info2nd"> Deacons can baptize, witness marriages, preach, and assist during the mass,  </p>
                    <p class="info2nd">but they cannot consecrate the Eucharist or hear confessions. </p>
                    <p class="info2nd">With the exception of married deacons, an order restored by the Second Vatican Council, all ordained men are to be celibate.</p>
                </div>
            </div>
        </div><br><br>
         <!-- Logos Section -->
            <div id="logosDiv" class="text-center">
                <div class="logoContainer">
                    <p class="label">The Official Logo of Parokya ng San Bautista</p>
                    <img src="../Images/logo1.png" class="logos" alt="Logo 1">
                </div>
                <div class="logoContainer">
                    <p class="label">The Official Logo of Parokya ng San Bautista</p>
                    <img src="../Images/logo2.png" class="logos" alt="Logo 2">
                </div>
            </div><br>

            <!-- Copyright -->
            <p class="copyright">&copy; Britannica.com</p>

    </div>
</body>
</html>
