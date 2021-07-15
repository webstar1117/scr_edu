/// <summary>
/// <code>ActivityTimer</code> is used to monitor user activity and keep
/// the server session active through predetermine pingbacks.
/// <param name="logoutUrl">The target url to redirect to for logout.</param>
/// <param name="warningTimeframe">The allowed inactivity in seconds before the <see cref="#InactivityNotification"/> dialog is displayed.</param>
/// <param name="logoutTimeframe">The allowed inactivity in seconds before the page is redirected to the logout page.</param>
/// <param name="pingbackServiceUrl">The service to pingback to.</param>
/// <param name="pingbackFrequency">The frequency in seconds to pingback to the server to.</param>
/// </summary>
function ActivityTimer(
    logoutUrl,
    logoutTimeframe,
    pingbackServiceUrl,
    pingbackFrequency) {

  // #region Member Fields

  var urlPingbackServiceUrl = pingbackServiceUrl;
  var urlLogoutTarget = logoutUrl;

  var timeframeInactivityLogout = logoutTimeframe;
  var timeframePingback = pingbackFrequency;

  var inactivityStartClientSide = new Date().getTime() / 1000;
  var inactivityStartServerSide = new Date().getTime() / 1000;

  // #endregion

  // #region Constructors

  /// <summary>
  /// Initializes the activity timer.
  /// </summary>
  function startMonitor() {
    
    // Start the timers.
    setTimeout(timerServerInteractionTick, 1000);
    setTimeout(timerClientInteractionTick, 1000);
  }

  // #endregion

  // #region Public Methods

  /// <summary>
  /// Method that is used to update the server interactive session.
  /// </summary>
  function timerServerInteractionTick() {
    var heartbeatTimeFrame = (new Date().getTime() / 1000) - inactivityStartServerSide;
    if (heartbeatTimeFrame > timeframePingback) {
      inactivityStartServerSide = new Date().getTime() / 1000;
      pingServerConnection();
    }
    setTimeout(timerServerInteractionTick, 1000);
  }

  /// <summary>
  /// Method that is used to update the client side session.
  /// </summary>
  function timerClientInteractionTick() {
    var heartbeatTimeFrame = (new Date().getTime() / 1000) - inactivityStartClientSide;
   
    if (heartbeatTimeFrame < timeframeInactivityLogout) {
      setTimeout(timerClientInteractionTick, 1000);
    }
    else {
      window.location.href = urlLogoutTarget;
    }
  };

  /// <summary>
  /// Method that is to do a server pingback.
  /// </summary>
  function pingServerConnection() {    
    $.ajax({
      url: urlPingbackServiceUrl,
      cache: false,
      type: 'GET',
      async: true
    });
  };

  // #endregion

  // #region Events

  /// <summary>
  /// Event that is raised on any document related client side interaction.
  /// </summary>
  $(document).on("mouseover click keydown", function () {
    inactivityStartClientSide = new Date().getTime() / 1000;
  });
  
 // #endregion

  // #region Public Properties.

  return {
    startMonitor: startMonitor
  };

  // #endregion
};




